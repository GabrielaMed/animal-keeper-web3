<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showSignupForm()
    {
        return view('signup');
    }

    public function signup(Request $request)
    {
        if (empty($request->cpf) && empty($request->passport)) {
            return back()->withErrors([
                'cpf' => 'Either CPF or Passport must be provided.',
                'passport' => 'Either CPF or Passport must be provided.',
            ]);
        }

        $user_profile = UserProfile::where('slug_name', $request->profile_name)->first();

        if (!$user_profile) {
            return back()->withErrors([
                'profile_name' => 'Invalid profile name provided.',
            ]);
        }

        $user = User::create([
            'id' => Str::uuid(),
            'name' => $request->name,
            'birthdate' => $request->birthdate,
            'cpf' => $request->cpf,
            'passport' => $request->passport,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar_path' => $request->avatar_path || 'default.jpg',
            'profile_id' => $user_profile->id,
        ]);

        Auth::login($user);

        return redirect()->route('login')->with('success', 'Signup successful! Please login.');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/home');
    }
}
