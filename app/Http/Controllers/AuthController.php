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
        if (Auth::attempt($credentials,$request->input("remember"))) {
            session()->regenerate();
            return Inertia::location(route("home"));
        }
        return back()->withErrors([
            'user' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route("home");
    }
}
