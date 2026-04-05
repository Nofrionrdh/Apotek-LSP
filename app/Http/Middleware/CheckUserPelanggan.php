<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserJabatan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if (Auth::guard('pelanggan')->check()) {
            return $next($request);
        }

        foreach ($roles as $role) {
            if (Auth::user()->level === $role) {
                return $next($request);
            }
        }

        return redirect('/profile.index');
    }
}
