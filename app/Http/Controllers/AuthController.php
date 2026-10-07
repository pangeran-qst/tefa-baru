<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
            return redirect()->intended('/');
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

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'no_hp' => $validated['no_hp'] ?? null,
            'alamat' => $validated['alamat'] ?? null,
            'password' => $validated['password'],
            'role' => 'client',
            'jurusan' => null,
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->intended('/')
            ->with('success', 'Pendaftaran berhasil. Selamat datang!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // 1. Menampilkan form input email (Lupa Password)
    public function showLinkRequestForm()
    {
        return view('lupa-password');
    }

    // 2. Memproses pengiriman link ke email
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.'
        ]);

        // Mengirim link reset password
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Cek apakah berhasil dikirim atau email tidak ditemukan
        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', 'Link reset password telah dikirim ke email Anda!');
        }

        return back()->withErrors(['email' => 'Email tidak ditemukan di sistem kami.']);
    }

    // Menampilkan halaman form lupa password
    public function showResetForm(Request $request, $token = null)
    {
        return view('reset-password')->with([
            'token' => $token,
            'email' => $request->email
        ]);
    }

    // Memproses simpan password baru
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ], [
            'password.required' => 'Password baru wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', 'Password berhasil diubah! Silakan login.');
        }

        return back()->withErrors(['email' => __($status)]);
    }

}
