<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class Authenticate
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            return redirect()->route('login');
        }


        if (Auth::user()->role_id === 1) {
            return redirect()->route('admin.adminpanel');
        } elseif (Auth::user()->role_id === 2) {
            return redirect()->route('user.userpanel');
        }
        return $next($request);
    }
}
