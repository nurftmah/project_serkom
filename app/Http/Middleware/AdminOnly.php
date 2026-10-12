<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminOnly
{
    public function handle(Request $request, Closure $next): Response
    {
        // Jika belum login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Jika bukan Admin
        if (Auth::user()->role !== 'Admin') {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Operator tidak memiliki hak akses ke menu Pengguna.');
        }

        return $next($request);
    }
}
