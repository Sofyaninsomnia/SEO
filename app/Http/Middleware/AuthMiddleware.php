<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return response()->json([
                'message' => 'Anda harus login untuk mengakses halaman ini.'
            ], 401);
        }

        // Cek apakah user yang login adalah superadmin
        if (Auth::user()->role !== 'superadmin') {
            return response()->json([
                'message' => 'Anda tidak memiliki hak akses.'
            ], 403); // Kode 403 (Forbidden) lebih tepat
        }

        return $next($request);
    }
}
