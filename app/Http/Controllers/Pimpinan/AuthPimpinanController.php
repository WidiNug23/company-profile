<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthPimpinanController extends Controller
{
    // Tampilkan form login pimpinan
    public function showLogin()
    {
        return view('pimpinan.auth.login');
    }

    // Proses login pimpinan
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // ✅ CEK ROLE PIMPINAN (INTEGER, KONSISTEN DENGAN ADMIN)
            if (Auth::user()->role_id !== 3) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->withErrors([
                    'email' => 'Bukan akun pimpinan'
                ]);
            }

            return redirect()->route('pimpinan.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah'
        ]);
    }

    // Logout pimpinan
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('pimpinan.login');
    }
}
