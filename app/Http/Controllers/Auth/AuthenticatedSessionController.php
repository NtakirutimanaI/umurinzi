<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Show the login form.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Optional alias for showing login.
     */
    public function showLogin(): View
    {
        return $this->create();
    }

    /**
     * Handle the login submission and redirect based on role.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Validate and authenticate
        $request->authenticate();

        // Prevent session fixation
        $request->session()->regenerate();

        $user = $request->user();
        $role = strtolower($user->role);

        // Redirect according to role
        return match ($role) {
            'admin'         => redirect()->route('admin.dashboard'),
            'manager'       => redirect()->route('manager.dashboard'),
            'supervisor'    => redirect()->route('supervisor.dashboard'),
            'businessperson'=> redirect()->route('businessperson.dashboard'),
            'technician'    => redirect()->route('technician.dashboard'),
            'mechanic'      => redirect()->route('mechanic.dashboard'),
            'tailor'        => redirect()->route('tailor.dashboard'),
            'craftsperson'  => redirect()->route('craftsperson.dashboard'),
            'mediator'      => redirect()->route('mediator.dashboard'),
            'client'        => redirect()->route('client.dashboard'),
            default         => redirect()->route('dashboard'),
        };
    }

    /**
     * Logout the user and destroy the session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
