<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Hash;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

    // Tampilkan form login pelanggan
    public function showLoginForm()
    {
        return view('fe.pelanggan.login');
    }

    // Proses login pelanggan
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'katakunci' => 'required|min:4',
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'katakunci.required' => 'Password harus diisi',
            'katakunci.min' => 'Password minimal 4 karakter',
        ]);

        $pelanggan = Pelanggan::where('email', $request->email)->first();
        
        if ($pelanggan && $pelanggan->katakunci === $request->katakunci) {
            // Set session untuk pelanggan
            session(['pelanggan' => $pelanggan]);
            return redirect('/')->with('success', 'Login berhasil!');
        }

        return back()->withErrors(['login' => 'Email atau password salah.'])->withInput();
    }

    // Tampilkan form register pelanggan
    public function showRegisterForm()
    {
        return view('fe.pelanggan.register');
    }

    // Proses register pelanggan
    public function register(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'email' => 'required|email|unique:pelanggans,email',
            'katakunci' => 'required|min:4|max:15',
            'no_telp' => 'required|max:15',
        ]);

        $pelanggan = Pelanggan::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'email' => $request->email,
            'katakunci' => $request->katakunci,
            'no_telp' => $request->no_telp,
            'alamat1' => $request->alamat1 ?? '',
            'kota1' => $request->kota1 ?? '',
            'propinsi1' => $request->propinsi1 ?? '',
            'kodepos1' => $request->kodepos1 ?? '',
        ]);

        session(['pelanggan' => $pelanggan]);
        return redirect()->route('profile.index');
    }

    // Logout pelanggan
    public function logout(Request $request)
    {
        // Hapus session pelanggan
        $request->session()->forget('pelanggan');
        return redirect('/')->with('success', 'Logout berhasil!'); // Ubah redirect ke root URL
    }
}
