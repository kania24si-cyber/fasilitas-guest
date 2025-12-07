<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('auth.index')
                ->with('error', 'Silakan login terlebih dahulu!');
        }

        // Samakan huruf kecil
        $userRole = strtolower(Auth::user()->role);
        $roles = array_map('strtolower', $roles);

        if (!in_array($userRole, $roles)) {
            return abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
