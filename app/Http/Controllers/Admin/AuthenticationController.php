<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function loginAction(AdminLoginRequest $request)
    {
        $admin = Admin::query()
            ->where('username', $request->username)
            ->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return redirect()->back()->withErrors([
                'username' => 'The provided credentials do not match our records.',
            ]);
        }

        auth('admin')->login($admin);

        return redirect()->route('admin.dashboard');
    }
}
