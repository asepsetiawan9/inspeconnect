<?php
namespace App\Http\Middleware;

use Closure;

class CheckRoleMiddleware
{
    public function handle($request, Closure $next)
    {
        // Mendapatkan peran pengguna saat ini
        $userRole = auth()->user()->role;

        // Cek peran pengguna dan sesuaikan dengan yang diizinkan
        if ($userRole === 'warga') {
            // Jika peran adalah 'warga', redirect ke halaman yang sesuai
            return redirect()->route('dashboard');
        } elseif ($userRole === 'skpd') {
            // Jika peran adalah 'skpd', redirect ke halaman yang sesuai
            return redirect()->route('dashboard');
        }

        // Jika peran adalah 'admin' atau role tidak dikenali, lanjutkan ke route berikutnya
        return $next($request);
    } 
}
