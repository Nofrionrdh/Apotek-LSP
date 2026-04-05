<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Pelanggan;

class AuthController extends Controller
{
    // Show login form
    public function login()
    {
        return view("auth.login");
    }
    public function register()
    {
        return view("auth.register");
    }

    // Handle user registration
    public function registerUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'jabatan' => 'required|in:admin,apoteker,karyawan,kasir,pemilik,kurir',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'jabatan' => $request->jabatan,
            'aktif' => 1,
        ]);

        if ($request->jabatan == 'pelanggan') {
            // Insert ke tabel pelanggan
            Pelanggan::create([
                'id_user' => $user->id,
                'nama_lengkap' => $request->name,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
            ]);
        }

        if ($user->save()) {
            Auth::login($user);
            $request->session()->put('loginId', $user->id);
            switch (Auth::user()->jabatan) {
                case 'admin':
                    return redirect()->intended('/admin')->with('success', 'Registrasi berhasil!');
                case 'karyawan':
                    return redirect()->intended('/karyawan')->with('success', 'Registrasi berhasil!');
                case 'pemilik':
                    return redirect()->intended('/pemilik')->with('success', 'Registrasi berhasil!');
                case 'kasir':
                    return redirect()->intended('/kasir')->with('success', 'Registrasi berhasil!');
                case 'apoteker':
                    return redirect()->intended('/apoteker')->with('success', 'Registrasi berhasil!');
                case 'kurir':
                    return redirect()->intended('/kurir')->with('success', 'Registrasi berhasil!');
                default:
                    return redirect()->intended('/home')->with('success', 'Registrasi berhasil!');
            }
            return back()->withErrors(['email' => 'Email atau Password Salah.']);
            return back()->withErrors('password', 'Password minimal 8 karakter.');
        }
    }


    // Handle login request
    public function loginUser(Request $request)
    {
        // Validate credentials
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = User::where('email', '=', $request->email)->first();
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $request->session()->put('loginId', $user->id);

            // Redirect based on user role
            switch (Auth::user()->jabatan) {
                case 'admin':
                    return redirect()->intended('/admin');
                case 'apoteker':
                    return redirect()->intended('/apoteker');
                case 'karyawan':
                    return redirect()->intended('/karyawan');
                case 'kasir':
                    return redirect()->intended('/kasir');
                case 'pemilik':
                    return redirect()->intended('/pemilik');
                case 'kurir':
                    return redirect()->intended('/kurir');
                default:
                    return redirect('/home');
            }
        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->forget('loginId');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logout berhasil!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
