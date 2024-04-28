<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $credentials = $request->validate(["email" => "required", "password" => "required"]);
        if (Auth::attempt($credentials)) {
            session()->regenerate();
            return Inertia::location(route("home"));
        }
        return back()->withErrors([
            'user' => 'The provided credentials do not match our records.',
        ]);

    }
    public function register(Request $request)
    {
        $credentials = $request->validate([
            "name" => "required",
            "email" => "required",
            "password" => "required",
            "termsAndPrivacy" => "required|accepted"
        ]);
        if (User::where("email", $credentials["email"])->doesntExist()) {
            $user = User::create($credentials);
            Auth::login($user, $remember = true);
            return Inertia::location(route("home"));
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route("home");
    }
}
