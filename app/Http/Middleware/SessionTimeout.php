<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class SessionTimeout
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $lastActivity = Session::get('last_activity');
            $sessionLifetime = config('session.lifetime') * 600; // Convert minutes to seconds
            
            if ($lastActivity && Carbon::now()->timestamp - $lastActivity > $sessionLifetime) {
                // Session has expired
                Auth::logout();
                Session::flush();
                Session::regenerate();
                
                return redirect()->route('login')
                    ->with('message', 'Your session has expired due to inactivity. Please log in again.');
            }
            
            // Update last activity timestamp
            Session::put('last_activity', Carbon::now()->timestamp);
        }
        
        return $next($request);
    }
}