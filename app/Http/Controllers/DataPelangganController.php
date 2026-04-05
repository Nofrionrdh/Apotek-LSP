<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;

class DataPelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelanggans = \App\Models\Pelanggan::paginate(5);
        return view('be.data-pelanggan.index', compact('pelanggans'));
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
        $pelanggan = Pelanggan::find($id);
        if ($pelanggan) {
            $pelanggan->delete();
            return redirect()->route('data-pelanggan.index')->with('success', 'Data pelanggan berhasil dihapus.');
        }
        return redirect()->route('data-pelanggan.index')->with('error', 'Data pelanggan tidak ditemukan.');
    }
}
