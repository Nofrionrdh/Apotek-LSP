<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$jabatan)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            $userjabatan = Auth::user()->jabatan;
            
            // Tambahkan logging untuk debug
            // \Log::info('User jabatan: ' . $userjabatan);
            // \Log::info('Allowed jabatan: ' . implode(',', $jabatan));
            
            // Check if the user's jabatan matches the allowed jabatans
            if (!in_array($userjabatan, $jabatan)) {
                // Redirect to the appropriate dashboard based on their role
                switch ($userjabatan) {
                    case 'admin':
                        return redirect('/admin');
                    case 'karyawan':
                        return redirect('/karyawan');
                    case 'pemilik':
                        return redirect('/pemilik');
                    case 'apoteker':
                        return redirect('/apoteker');
                    case 'kasir':
                        return redirect('/kasir');
                    case 'kurir':
                        return redirect('/kurir');
                }
            }
        }

        return $next($request);
    }
}
