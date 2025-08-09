<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password; // ✅ Correct namespace for password rules

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request): RedirectResponse
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'username' => ['required', 'string', 'max:50', 'unique:users'],
        'country_code' => ['required', 'string', 'max:10'],
        'phone' => ['required', 'string', 'max:20', 'unique:users'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'confirmed', Password::defaults()],
    ]);

    $user = User::create([
        'name' => $request->name,
        'username' => $request->username,
        'country_code' => $request->country_code,
        'phone' => $request->phone,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    event(new Registered($user));

    Auth::login($user);

    return redirect()->route('auth.register2'); // 🔁 Redirect to register2 view
}
public function showRegister2()
{
    return view('auth.register2');
}

}
