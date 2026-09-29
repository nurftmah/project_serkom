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
            // abort(403, 'Anda tidak memiliki akses untuk melakukan tindakan ini.');
            // return $next($request);
            return redirect()->route('admin.dashboard')->with('Anda tidak memiliki akses untuk melakukan tindakan ini');
        }

        return $next($request);
    }
}
