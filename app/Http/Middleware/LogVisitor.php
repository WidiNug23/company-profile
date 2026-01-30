<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\VisitorLog;

class LogVisitor
{
    public function handle(Request $request, Closure $next)
    {
        // Jalankan request dulu
        $response = $next($request);

        // Hanya catat request GET
        if (!$request->isMethod('get')) {
            return $response;
        }

        // Abaikan halaman admin & pimpinan
        if (
            $request->is('admin') ||
            $request->is('admin/*') ||
            $request->is('pimpinan') ||
            $request->is('pimpinan/*') ||
            $request->is('storage/*') ||
            $request->ajax()
        ) {
            return $response;
        }

        VisitorLog::create([
            'ip_address' => $request->ip(),
            'url'        => '/' . ltrim($request->path(), '/'),
            'user_agent' => $request->userAgent(),
        ]);

        return $response;
    }
}
