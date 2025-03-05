<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Jobs\SendOtpJob;
use App\Jobs\SendMailJob;
use App\Models\Backend\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function sendOtp()
    {
        dispatch(new SendOtpJob())->onQueue('high');
        return redirect()->back()->with('success','OTP Send !');
    }

    public function otpVerification()
    {
        return view('register.otpVerification');
    }

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
        try {
            DB::beginTransaction();
            // Default Image
            $uploadedFileUrl = 'https://res.cloudinary.com/demeqriqu/image/upload/v1739026688/Newspaper/Users-image/Default_image/user_default_image.png';
            $public_id = 'Newspaper/Users-image/Default_image/user_default_image';
            
            if ($request->hasFile('image')) {

                $timeStamp = Carbon::now()->format('Y-M');
                $folderName = 'Newspaper/Users-image/'.$timeStamp;
                $imageUniqueName = time();
    
                // Upload with image to cloudinary
                $uploadimage = cloudinary()->upload($request->file('image')->getRealPath(), [
                    'folder' => $folderName,
                    'public_id'=> $imageUniqueName
                ]);

                $uploadedFileUrl = $uploadimage->getSecurePath();
                $public_id = $uploadimage->getPublicId();
            }
    
            User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                'image_url'=>$uploadedFileUrl,
                'image_id'=>$public_id,
                'contacts'=>$request->number,
                'status'=>'inactive',
                'role'=>$request->role,
            ]);
            
            DB::commit();

            
            // for ($i=0; $i <10; $i++) { 
            //     dispatch(new SendMailJob((object)$request->all()));
            // }

            // dispatch(new SendMailJob((object)$request->all()));

            return redirect()->route('login')->with('success','Users Created Succesfully !');
            // return redirect()->route('user.verification')->with('success','Users Created Succesfully !');

        } catch (\Exception $err) {

            DB::rollBack();
            return redirect()->back()->with('error','Failed To Create Users !');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
