<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Http\Middleware\EnsureUserIsTeacher;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Register middleware priorities
        $middleware->priority([
            EnsureUserIsAdmin::class,
            EnsureUserIsTeacher::class,
            // Add other middleware classes here if needed
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();