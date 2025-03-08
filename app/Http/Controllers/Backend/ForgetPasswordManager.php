<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\ResetPasswordJob;
use App\Models\Backend\Password_reset_token;
use App\Models\Backend\User;

class ForgetPasswordManager extends Controller
{
    public function forgetPassword()
    {
        return view('login.forgetPassword');   
    }

    public function forgetPasswordPost(Request $request)
    {
        $request->validate([
            'email'=>'required|email|exists:users',
        ]);

        $token = Str::random(64);

        Password_reset_token::create([
            'email'=> $request->email,
            'token'=> $token
        ]);

        $data = $request->all();
        $data['token'] = $token;

        dispatch(new ResetPasswordJob((object)$data));

        return redirect()->back()->with('success','We have send an email to reset password.');
    }

    public function resetPassword(string $token)
    {
        return view('login.newPassword', compact('token'));
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

        User::where('email',$request->email)->update([
            'password'=> $request->password,
        ]);

        Password_reset_token::where('email',$request->email)->delete();

        return redirect()->route('login')->with('success','Password Reset Success !');
    }
}
