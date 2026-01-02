<?php

use App\Http\Middleware\CheckIfAuthForChat;
use App\Http\Middleware\SetLocale;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
           'auth.chat'=> CheckIfAuthForChat::class,
        ]);
       $middleware->web([
           SetLocale::class
       ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
