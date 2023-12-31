<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginAction(LoginRequest $request)
    {
        $user = User::query()
            ->where('email', $request->email)
            ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return redirect()->back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }

        auth()->login($user);

        return redirect()->route('home');
    }

    public function register()
    {
        return view('register');
    }

    public function registerAction(RegisterRequest $request)
    {
        $user = new User($request->except(['password_confirmation', 'password']));
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login');
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('login');
    }
}
