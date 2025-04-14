<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Replaced the built-in CSRF middleware with custom one
        $middleware->web(\App\Http\Middleware\VerifyCsrfToken::class);  

        // Session Security
        $middleware->web(\App\Http\Middleware\SessionSecurity::class);

        // Session Timeout
        $middleware->web(\App\Http\Middleware\SessionTimeout::class);
        
        // Require a password
        $middleware->alias([
            'password.confirm' => \App\Http\Middleware\RequirePassword::class
        ]);
})
->withExceptions(function (Exceptions $exceptions) {

})->create();