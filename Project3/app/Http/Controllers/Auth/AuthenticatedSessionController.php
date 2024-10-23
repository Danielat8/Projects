<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */

    public function store(LoginRequest $request): RedirectResponse
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            Log::info('User authenticated: ', ['email' => $request->email]);

            if (Auth::user()->is_banned) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect('/login')->with('error', 'Your account has been banned for 3 days.');
            }

            if (Auth::user()->role_id === 1) {
                return redirect()->route('admin.adminpanel');
            } elseif (Auth::user()->role_id === 2) {
                return redirect()->route('user.userpanel');
            }

            return redirect('/');
        }


        Log::warning('Failed login attempt: ', ['email' => $request->email]);

        return redirect('/login')->with('error', 'Invalid credentials.');
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
