<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function formSuperadmin()
    {
        return view('auth.superadmin-login');
    }

    public function loginSuperadmin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('web')->attempt($credentials)) {
            $user = Auth::guard('web')->user();

                if ($user->role === 'superadmin') {
                    Session::put('email', $user->email);
                    Session::put('name',  $user->name);
                    Session::put('role',  $user->role);
                    Session::put('foto',  $user->foto);
                $request->session()->regenerate();
                return redirect()->route('superadmin.dashboard');
            }

            Auth::guard('web')->logout();
            return back()->withErrors(['email' => 'Hanya admin yang bisa login.']);
        }

        return back()->withErrors(['email' => 'Kredensial tidak valid.']);
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
