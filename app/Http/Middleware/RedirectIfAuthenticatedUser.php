<?php

namespace App\Http\Middleware;

use App\Models\Module;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticatedUser
{
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        $guards = empty($guards) ? ['web'] : $guards;
        foreach ($guards as $guard) {
            if (! Auth::guard($guard)->check()) {
                continue;
            }
            if ($guard === 'associate') {
                return redirect()->route('associate-panel.dashboard');
            }
            if ($guard === 'customer') {
                return redirect()->route('customer-panel.dashboard');
            }
            return redirect()->to($this->adminRedirect());
        }
        return $next($request);
    }

    private function adminRedirect(): string
    {
        $user = Auth::guard('web')->user();
        if (! $user) {
            return route('login');
        }
        if ($user->hasRole('Admin')) {
            return route('dashboard');
        }
        $modules = Module::whereNotNull('route_name')->whereNotNull('slug')->orderBy('sort_order')->orderBy('id')->get();
        foreach ($modules as $module) {
            $permission = $module->slug . '-list';
            if ($user->can($permission) && Route::has($module->route_name)) {
                return route($module->route_name);
            }
        }
        Auth::guard('web')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return route('login');
    }
}