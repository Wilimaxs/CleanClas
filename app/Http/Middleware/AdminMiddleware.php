<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Mengakses data admin dari sesi
        $admin = session('admin');

        $guru = session('guru');
        $siswa = session('siswa');
        // Menyimpan data admin ke dalam request untuk diakses oleh controller
        $request->merge(['admin' => $admin]);
        $request->merge(['guru' => $guru]);
        $request->merge(['siswa' => $siswa]);

        return $next($request);
    }
}
