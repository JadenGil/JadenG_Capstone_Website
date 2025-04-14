<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Session\TokenMismatchException;
use Closure;
use Illuminate\Support\Facades\Log;

class VerifyCsrfToken extends Middleware
{
    protected $except = [
        'api/*',
        'webhook/*',
    ];
    
    public function handle($request, Closure $next)
    {
        try {
            return parent::handle($request, $next);
        } catch (TokenMismatchException $exception) {
            // Log the CSRF failure
            Log::warning('CSRF Verification Failed', [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'url' => $request->fullUrl(),
                'method' => $request->method(),
            ]);
            
            // Redirect back with error message
            if ($request->expectsJson()) {
                return response()->json(['message' => 'CSRF token mismatch.'], 419);
            }
            
            return redirect()->back()->withErrors(['csrf' => 'Your session has expired. Please try again.']);
        }
    }
}