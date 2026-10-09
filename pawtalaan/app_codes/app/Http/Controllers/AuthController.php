<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function showRegister(): View
    {
        return view('auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $request->merge(['phone' => $this->normalizePhone((string) $request->phone, (string) $request->input('country_code', '+63'))]);
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'regex:/^\+?[0-9]{10,15}$/', 'unique:users,phone'],
            'gender' => ['nullable', 'in:female,male,non_binary,prefer_not_to_say'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = User::create($validated);
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('home')->with('status', 'Welcome to PawTalaan! Your account is ready.');
    }

    public function login(Request $request): RedirectResponse
    {
        $request->merge(['phone' => $this->normalizePhone((string) $request->phone, (string) $request->input('country_code', '+63'))]);
        $credentials = $request->validate([
            'phone' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors(['phone' => 'The phone number or password is incorrect.'])->onlyInput('phone');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('home'));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    private function normalizePhone(string $phone, string $countryCode = '+63'): string
    {
        $phone = preg_replace('/[^0-9+]/', '', trim($phone)) ?? '';
        if (str_starts_with($phone, '+')) {
            return $phone;
        }

        return '+'.preg_replace('/\D/', '', $countryCode).ltrim($phone, '0');
    }
}
