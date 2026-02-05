<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DataUserController extends Controller
{
    public function showLogin() {
        return view('super-admin-management.loginSuperAdminManagement');
    }

public function login(Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        // SESUAIKAN DISINI: role_id 99
        if (Auth::user()->role_id == 99) { 
            $request->session()->regenerate();
            return redirect()->intended(route('superadmin.dashboard'));
        }
        
        Auth::logout();
        return back()->withErrors(['email' => 'Bukan akses Super Admin.']);
    }
    return back()->withErrors(['email' => 'Email atau password salah.']);
}

    public function index() {
        // Ambil semua user kecuali dirinya sendiri
        $users = User::with('role')->where('user_id', '!=', Auth::id())->get();
        return view('super-admin-management.dashboard', compact('users'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role_id' => 'required|in:2,3,99' // 2: Admin, 3: Pimpinan
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        return back()->with('success', 'User berhasil ditambahkan!');
    }

    public function destroy($id) {
        User::destroy($id);
        return back()->with('success', 'User berhasil dihapus!');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('superadmin.login');
    }
}