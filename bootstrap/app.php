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
    ->withMiddleware(function (Middleware $middleware): void {
        // LAB CONCEPT: Middleware Registration & Aliasing
        // Register custom middleware with short aliases for use in routes
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'author' => \App\Http\Middleware\AuthorMiddleware::class,
            'banned' => \App\Http\Middleware\CheckBannedUser::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
