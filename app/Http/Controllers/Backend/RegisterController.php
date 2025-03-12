<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Jobs\SendOtpJob;
use App\Models\Backend\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Jobs\RegisterSuccessJob;
use App\Models\Backend\EmailOtp;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('register.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $otp = rand(10000,99999);

        EmailOtp::updateOrCreate(['email'=> $request->email],[
            'email'=> $request->email,
            'otp'=> $otp,
            'expired_at'=> Carbon::now()->addMinute(5)
        ]);

        dispatch(new SendOtpJob($request->email,$otp))->onQueue('high');

        if ($request->hasFile('image')) {

            $timeStamp = Carbon::now()->format('Y-M');
            $folderName = 'Newspaper/Users-image/Temp_images/'.$timeStamp;
            $imageUniqueName = time();

            // Upload with image to cloudinary
            $tempImage = cloudinary()->upload($request->file('image')->getRealPath(), [
                'folder' => $folderName,
                'public_id'=> $imageUniqueName
            ]);

            $temp_image_Url = $tempImage->getSecurePath();
            $temp_image_id = $tempImage->getPublicId();

            $request->session()->put('temp_image_url', $temp_image_Url);
            $request->session()->put('temp_image_id', $temp_image_id);
        }

        $request->session()->put('name',$request->name);
        $request->session()->put('email',$request->email);
        $request->session()->put('password',Hash::make($request->password));
        $request->session()->put('number',$request->number);
        $request->session()->put('role',$request->role);

        return redirect()->route('verify.otp')->with('success','OTP Send ! Please check your email.');
    }

    public function verifyOtp(Request $request)
    {
        $email = $request->session()->get('email');
        return view('register.otpVerification',compact('email'));
    }

    public function vrrifyOtpStore(Request $request) 
    {
        $request->validate([
            'otp' => 'required|array|size:5',
            'otp.*' => 'required|integer|between:0,9',
        ]);

        $otpCode = implode('', $request->otp);

        $name = $request->session()->get('name');
        $email = $request->session()->get('email');
        $password = $request->session()->get('password');
        $tempImageUrl = $request->session()->get('temp_image_url');
        $tempImageId = $request->session()->get('temp_image_id');
        $number = $request->session()->get('number');
        $role = $request->session()->get('role');

        $emailOtp =  EmailOtp::where('email', $email)
                            ->where('otp',$otpCode)
                            ->where('expired_at','>=',Carbon::now())
                            ->first();

        if (!$emailOtp) {
            return redirect()->back()->withInput()->with('warning','Invalid OTP or OTP has expired !');
        }

        try {
            DB::beginTransaction();
            // Default Image
            $uploadedFileUrl = 'https://res.cloudinary.com/demeqriqu/image/upload/v1739026688/Newspaper/Users-image/Default_image/user_default_image.png';
            $public_id = 'Newspaper/Users-image/Default_image/user_default_image';
            
            if ($tempImageUrl && $tempImageId) {

                $timeStamp = Carbon::now()->format('Y-M');
                $folderName = 'Newspaper/Users-image/'.$timeStamp;
                $imageUniqueName = time();
                // Upload with image to cloudinary
                $uploadimage = cloudinary()->upload($tempImageUrl, [
                    'folder' => $folderName,
                    'public_id'=> $imageUniqueName
                ]);

                $uploadedFileUrl = $uploadimage->getSecurePath();
                $public_id = $uploadimage->getPublicId();

                cloudinary()->destroy($tempImageId);
            }
    
            User::create([
                'name'=>$name,
                'email'=>$email,
                'password'=>$password,
                'image_url'=>$uploadedFileUrl,
                'image_id'=>$public_id,
                'contacts'=>$number,
                'status'=>'inactive',
                'role'=>$role,
            ]);

            $emailOtp->delete();

            dispatch(new RegisterSuccessJob($name,$email));

            $request->session()->forget([
                'name', 'email', 'password', 'temp_image_url', 'temp_image_id', 'number', 'role'
            ]);
            
            DB::commit();
            return redirect()->route('login')->with('success','Users Created Succesfully !');

        } catch (\Exception $err) {

            DB::rollBack();
            return redirect()->back()->with('error','Failed To Create Users !');
        }
    }
}
