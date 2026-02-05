<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
public function handle($request, Closure $next, ...$roles)
{
    if (!Auth::check()) {
        // Redirect ke login super admin jika mencoba akses area super admin
        if ($request->is('super-admin/*')) {
            return redirect()->route('superadmin.login');
        }
        return redirect('/login');
    }

    $user = Auth::user();
    
    // Ambil nama role dari relasi (pastikan huruf kecil untuk perbandingan)
    $userRoleName = strtolower($user->role->role_name ?? '');
    $userRoleId = $user->role_id;

    foreach ($roles as $role) {
        // Cek berdasarkan Nama (misal: 'super_admin') 
        // ATAU cek berdasarkan ID (misal: 99)
        if ($userRoleName === strtolower($role) || $userRoleId == $role) {
            return $next($request);
        }
        
        // Tambahan khusus: jika di route tulis 'super_admin', tapi di DB 'super admin' (pakai spasi)
        if (str_replace('_', ' ', strtolower($role)) === $userRoleName) {
            return $next($request);
        }
    }

    abort(403, 'Akses ditolak. Role Anda: ' . ($userRoleName ?: $userRoleId));
}

}
