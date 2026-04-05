<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Cek apakah ada session pelanggan
        if (!session()->has('pelanggan')) {
            return redirect()->route('pelanggan.login');
        }

        $pelangganId = session('pelanggan')->id;
        $pelanggan = Pelanggan::find($pelangganId);

        if (!$pelanggan) {
            return redirect()->route('pelanggan.login');
        }

        return view('fe.profile.index', [
            'title' => 'Profile',
            'pelanggan' => $pelanggan,
        ]);
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
        // Validasi request
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:pelanggans,email,'.$id,
            'no_telp' => 'nullable|string|max:20',
            'katakunci' => 'nullable|string|min:6',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'alamat1' => 'nullable|string',
            'kota1' => 'nullable|string',
            'propinsi1' => 'nullable|string',
            'kodepos1' => 'nullable|string',
            'alamat2' => 'nullable|string',
            'kota2' => 'nullable|string',
            'propinsi2' => 'nullable|string',
            'kodepos2' => 'nullable|string',
            'alamat3' => 'nullable|string',
            'kota3' => 'nullable|string',
            'propinsi3' => 'nullable|string',
            'kodepos3' => 'nullable|string',
            'url_ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Dapatkan pelanggan yang akan diupdate
        $pelanggan = Pelanggan::findOrFail($id);

        // Update data dasar
        $pelanggan->nama_pelanggan = $request->nama_pelanggan;
        $pelanggan->email = $request->email;
        $pelanggan->no_telp = $request->no_telp;

        // Update password jika diisi
        if ($request->katakunci) {
            $pelanggan->katakunci = $request->katakunci;
        }

        // Handle upload foto
        if ($request->hasFile('foto')) {
            if ($pelanggan->foto) {
                Storage::delete('public/' . $pelanggan->foto);
            }
            $path = $request->file('foto')->store('pelanggan/foto', 'public');
            $pelanggan->foto = $path;
        }

        // Update alamat - perbaiki nama kolom sesuai database
        $pelanggan->alamat1 = $request->alamat1;
        $pelanggan->kota1 = $request->kota1;
        $pelanggan->propinsi1 = $request->propinsi1;
        $pelanggan->kodepos1 = $request->kodepos1;
        
        $pelanggan->alamat2 = $request->alamat2;
        $pelanggan->kota2 = $request->kota2;
        $pelanggan->propinsi2 = $request->propinsi2;
        $pelanggan->kodepos2 = $request->kodepos2;
        
        $pelanggan->alamat3 = $request->alamat3;
        $pelanggan->kota3 = $request->kota3;
        $pelanggan->propinsi3 = $request->propinsi3;
        $pelanggan->kodepos3 = $request->kodepos3;

        // upload KTP
        if ($request->hasFile('url_ktp')) {
            if ($pelanggan->url_ktp) {
                Storage::delete('public/' . $pelanggan->url_ktp);
            }
            $path = $request->file('url_ktp')->store('pelanggan/ktp', 'public');
            $pelanggan->url_ktp = $path;
        }

        // Simpan perubahan
        $pelanggan->save();

        // Update session dengan data terbaru
        session(['pelanggan' => $pelanggan]);

        return redirect('/')->with('success', 'Profil berhasil diperbarui!'); // Ubah redirect ke home
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
