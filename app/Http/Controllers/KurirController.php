<?php

namespace App\Http\Controllers;

use App\Models\Pengiriman;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KurirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $namaKurir = Auth::user()->name;
        $pengirimans = Pengiriman::with('penjualan')
            ->where('nama_kurir', $namaKurir)
            ->latest()
            ->paginate(5);
        return view('be.kurir.index', compact('pengirimans'));
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

    public function setDikirim($id)
    {
        $pengiriman = \App\Models\Pengiriman::findOrFail($id);
        $penjualan = $pengiriman->penjualan;
        if ($penjualan) {
            $penjualan->status_order = 'Dikirim';
            $penjualan->save();
            return redirect()->route('kurir.index')->with('success', 'Status order penjualan diubah menjadi Dikirim.');
        }
        return redirect()->route('kurir.index')->with('error', 'Penjualan tidak ditemukan.');
    }

    public function setSelesai($id)
    {
        $pengiriman = \App\Models\Pengiriman::findOrFail($id);
        $penjualan = $pengiriman->penjualan;
        if ($penjualan) {
            $penjualan->status_order = 'Selesai';
            $penjualan->save();
            return redirect()->route('kurir.index')->with('success', 'Status order penjualan diubah menjadi Selesai.');
        }
        return redirect()->route('kurir.index')->with('error', 'Penjualan tidak ditemukan.');
    }
}
