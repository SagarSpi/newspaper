<?php

namespace App\Http\Controllers\Backend;

use App\Models\Backend\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function loginPage() 
    {
        return view('login.login');
    }

    function loginPost(Request $request)
    {
        $inputs = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($inputs)) {
            return redirect()->route('dashboard')->with('success', 'Login successful');
        }
        return redirect()->back()->with('error','Login failed ! Please try again');
    }

    function logout()
    {
        
        User::where('id',Auth::user()->id)->update(['status'=>'inactive']);

        Auth::logout();
        
        return redirect()->route('login');
    }
}
