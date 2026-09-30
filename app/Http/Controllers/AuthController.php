<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
     public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            if (Auth::user()->role == 'client') {
            return redirect()->intended('/tefa');
        }

            if (Auth::user()->role == 'admin_tefa') {
                return redirect('/admin/tefa');
        }

            if (Auth::user()->role == 'admin_jurusan') {
                return redirect('/admin/jurusan');
        }

            if (Auth::user()->role == 'worker') {
                return redirect('/worker');
        }

        return redirect('/tefa');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
