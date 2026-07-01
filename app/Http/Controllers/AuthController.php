<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Module;
class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        $result = $this->authService->login($credentials);

        // if ($result['status']) {
        //     return redirect()
        //         ->route('dashboard')
        //         ->with('success', $result['message']);
        // }


        if ($result['status']) {
            return redirect()
                ->to($this->redirectAfterLogin())
                ->with('success', $result['message']);
        }


        return back()->withErrors([
            'email' => $result['message'],
        ]);
    }


    private function redirectAfterLogin(): string
    {
        $user = Auth::user();

        if ($user->hasRole('Admin')) {
            return route('dashboard');
        }

        $modules = Module::whereNotNull('route_name')
            ->whereNotNull('slug')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        foreach ($modules as $module) {
            $permission = $module->slug . '-list';

            if ($user->can($permission) && Route::has($module->route_name)) {
                return route($module->route_name);
            }
        }

        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return route('login');
    }
    public function logout()
    {
        $result = $this->authService->logout();

        return redirect()
            ->route('login')
            ->with('success', $result['message']);
    }
}