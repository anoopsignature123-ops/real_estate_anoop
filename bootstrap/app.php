<?php

use App\Http\Middleware\AdminAccessKey;
use App\Http\Middleware\CheckModulePermission;
use App\Http\Middleware\RedirectIfAuthenticatedUser;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectGuestsTo(function (Request $request) {
            if ($request->is('associate-panel*')) {
                return route('associate-panel.login');
            }

            if ($request->is('customer-panel*')) {
                return route('customer-panel.login');
            }

            return route('login');
        });

        $middleware->alias([
            'admin.key' => AdminAccessKey::class,
            'module.permission' => CheckModulePermission::class,
            'redirect.auth' => RedirectIfAuthenticatedUser::class,
        ]);

        $middleware->redirectUsersTo(function (Request $request) {
            if ($request->is('associate-panel*')) {
                return route('associate-panel.dashboard');
            }

            if ($request->is('customer-panel*')) {
                return route('customer-panel.dashboard');
            }


            return route('dashboard');
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
