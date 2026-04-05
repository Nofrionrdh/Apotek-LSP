<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisObat;
use Illuminate\Support\Facades\Storage;

class JenisObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenis_obat = \App\Models\JenisObat::orderBy('jenis')->paginate(5);
        return view('be.jenis-obat.index', compact('jenis_obat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenis_obat = JenisObat::all(); // ambil semua data jenis obat
        return view('be.jenis-obat.create', [
            'title' => 'Tambah Jenis Obat',
            'jenis_obat' => $jenis_obat
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:50',
            'deskripsi' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $gambar = $request->file('gambar');
        $nama_gambar = time() . '.' . $gambar->getClientOriginalExtension();
        $gambar->move(public_path('uploads/jenis-obat'), $nama_gambar);

        JenisObat::create([
            'jenis' => $request->nama_jenis,
            'deskripsi_jenis' => $request->deskripsi,
            'image_url' => 'uploads/jenis-obat/' . $nama_gambar
        ]);

        return redirect()->route('be.jenis-obat.index')
            ->with('success', 'Jenis obat berhasil ditambahkan');
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
    public function edit($id)
    {
        $jenis_obat = JenisObat::findOrFail($id);
        return view('be.jenis-obat.edit', [
            'title' => 'Edit Jenis Obat',
            'jenis_obat' => $jenis_obat
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jenis' => 'required'
        ]);

        $jenis_obat = JenisObat::findOrFail($id);
        $jenis_obat->update($request->all());

        return redirect()->route('be.jenis-obat.index')
            ->with('success', 'Jenis obat berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jenis_obat = JenisObat::findOrFail($id);
        
        // Hapus file gambar dari storage
        if($jenis_obat->image_url && file_exists(public_path($jenis_obat->image_url))) {
            unlink(public_path($jenis_obat->image_url));
        }
        
        $jenis_obat->delete();
        return redirect()->route('be.jenis-obat.index')
            ->with('success', 'Jenis obat berhasil dihapus');
    }
}
