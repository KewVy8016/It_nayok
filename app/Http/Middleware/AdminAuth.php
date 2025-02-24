<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('admins')->check()) {
            return redirect()->route('admin.login');
        }

        $user = Auth::guard('admins')->user();
        if ($user->role !== 'admin') {
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}

