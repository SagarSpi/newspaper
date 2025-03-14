<?php

namespace App\Http\Controllers\Backend;

use App\Models\Backend\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Cookie;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function loginPage() 
    {
        try {
            $savedEmail = Cookie::has('adminuser') ? Crypt::decryptString(Cookie::get('adminuser')) : '';
            $savedPassword = Cookie::has('adminpassword') ? Crypt::decryptString(Cookie::get('adminpassword')) : '';
            
        } catch (\Exception $e) {
            $savedEmail = '';
            $savedPassword = '';
        }

        return view('login.login',compact('savedEmail','savedPassword'));
    }

    /**
     * Function: googleLogin
     * Description: This function will redirect to given provider
     * @param NA
     * @return void
     */
    public function authProviderRedirect($provider)
    {
        if ($provider) {
            return Socialite::driver($provider)->redirect();
        }
        abort(404);
    }

    /**
     * Function: googleAuthentication
     * Description: This function will authenticate the user through the Google Account
     * @param NA
     * @return void
     */
    public function socialAuthentication($provider)
    {
        try {

            if ($provider) {

                $socialUser = Socialite::driver($provider)->user();
                $user = User::where('auth_provider_id',$socialUser->id)->first();

                if ($user) {
                    Auth::login($user);
                }
                else{
                    $userData = User::create([
                        'name'=> $socialUser->name,
                        'email'=> $socialUser->email,
                        'password'=> Hash::make('Dummy@Passwoard'),
                        'image_url'=> $socialUser->avatar,
                        'role'=> 'client',
                        'status'=> 'active',
                        'auth_provider'=>$provider,
                        'auth_provider_id'=>$socialUser->id,
                    ]);
                    if ($userData) {
                        Auth::login($userData);
                    }
                }
                return redirect()->route('dashboard');
            }
            abort(404);
            
        } catch (\Exception $err) {
            return redirect()->route('login')->with('error','Authentication Failed ! Please Try Again.');
        }
    }

    public function loginPost(Request $request)
    {
        $inputs = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'User not found.');
        }

        if ($user && $user->status === 'Rejected') {
            return redirect()->route('login')->withInput()->with('error','Your account has been rejected.');
        }

        if ($request->has('rememberMe')) {
            Cookie::queue('adminuser', Crypt::encryptString($request->email), 43200);
            Cookie::queue('adminpassword', Crypt::encryptString($request->password), 43200);
        }
        else {
            Cookie::queue(Cookie::forget('adminuser'));
            Cookie::queue(Cookie::forget('adminpassword'));
        }
        
        if (Auth::attempt($inputs)) {
            return redirect()->route('dashboard')->with('success', 'Login successful');
        }
        return redirect()->back()->with('error','Login failed ! Please try again');
    }

    public function logout()
    {
        User::where('id',Auth::user()->id)->update(['status'=>'inactive']);
        Auth::logout();
        
        return redirect()->route('login');
    }
}
