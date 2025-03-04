<?php

namespace App\Http\Middleware;

use App\Models\Backend\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->status === 'Rejected') {
                Auth::logout();
                return redirect()->route('login')->with('error','Your account has been rejected.');
            }
            User::where('id', $user->id)->update([
                'last_seen' => now(),
                'status' => 'active',
                'ip_address' => $request->ip(),
            ]);
        }
        return $next($request);
    }
}