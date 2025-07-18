<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php', // 👈 Très important !
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
            $middleware->alias([
   'roleuser' => \App\Http\Middleware\RoleUser::class,
   'producteur.validated' => \App\Http\Middleware\CheckProducteurValidated::class,
]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
