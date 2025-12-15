<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Log;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('auth.index')->with('error', 'Silakan login terlebih dahulu!');
        }

        // Pastikan role user dan role yang diterima adalah lowercase
        $userRole = strtolower(Auth::user()->role); 
        $roles = array_map('strtolower', (array) $roles);

        // Log untuk memastikan role yang diterima middleware
        Log::info('User Role in Middleware:', [$userRole]);

        // Periksa apakah userRole ada di dalam roles yang diterima
        if (!in_array($userRole, $roles)) {
            return abort(403, 'Access denied');
        }

        return $next($request);
    }
}
