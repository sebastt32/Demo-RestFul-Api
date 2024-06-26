<?php

use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'validateJsonApiHeaders' => \App\Http\Middleware\ValidateJsonApiHeaders::class,
            'validateJsonApiDocument' => \App\Http\Middleware\ValidateJsonApiDocument::class,

        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (JsonException $exception) {
            return response()->json($exception);
        });
    })->create();
