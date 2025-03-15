<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Str;
use App\Models\Backend\User;
use Illuminate\Http\Request;
use App\Jobs\ResetPasswordJob;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Backend\Password_reset_token;
use Illuminate\Support\Facades\Hash;

class ForgetPasswordManager extends Controller
{
    public function forgetPassword()
    {
        return view('login.forgetPassword');   
    }

    public function forgetPasswordPost(Request $request)
    {
        $request->validate([
            'email'=>'required|email|exists:users,email',
        ]);

        $token = Str::random(64);

        Password_reset_token::create([
            'email'=> $request->email,
            'token'=> $token
        ]);

        $data = $request->all();
        $data['token'] = $token;

        $request->session()->put('data',$data);

        dispatch(new ResetPasswordJob((object)$data))->onQueue('high');

        return redirect()->back()->with('success','We have send an email to reset password.');
    }

    public function resendEmail(Request $request)
    {
        $data = $request->session()->get('data');

        if ($data) {
            $email = $data['email'];

            $token = Str::random(64);

            Password_reset_token::where('email',$email)->update([
                'token'=>$token,
            ]);

            $data = $data;
            $data['token'] = $token;
    
            dispatch(new ResetPasswordJob((object)$data))->onQueue('high');

            return redirect()->back()->with('success','We have send email again to reset Password');
        }
        return redirect()->back()->with('error','email not found');
    }

    public function resetPassword(Request $request)
    {
        $token = $request->query('token');

        if (!$token) {
            abort(404); 
        }
        
        return view('login.newPassword',compact('token'));
    }

    public function resetPasswordPost(Request $request)
    {
        $request->validate([
            'email'=>'required|email|exists:users',
            'password'=>'required|confirmed|min:4'
        ]);

        $updatePassword = Password_reset_token::where([
            'email'=>$request->email,
            'token'=>$request->token,
        ])->first();

        if (!$updatePassword) {
            return redirect()->route('password.reset')->with('error','Invalid');
        }

        try {
            DB::beginTransaction();

            User::where('email',$request->email)->update([
                'password'=> Hash::make($request->password),
            ]);
    
            Password_reset_token::where('email',$request->email)->delete();

            DB::commit();
            return redirect()->route('login')->with('success','Password Reset Success !');

        } catch (\Exception $err) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error','Password Reset Unsuccessfully !');
        }
    }
}
