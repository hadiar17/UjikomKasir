<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Periksa apakah pengguna masuk dan memiliki peran yang sesuai
        if (Auth::check() && Auth::user()->role == $role) {
            return $next($request);
        }

        // Redirect pengguna ke halaman lain jika tidak memiliki akses
        return redirect('/dashboard')->with('error', 'Anda tidak memiliki akses untuk halaman tersebut.');
    }
}
