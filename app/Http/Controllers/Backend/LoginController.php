<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function loginPage() 
    {
        return view('backend.login');
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
        Auth::logout();
        return redirect()->route('login');
    }
}
