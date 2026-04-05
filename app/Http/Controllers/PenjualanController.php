<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Penjualan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penjualan = \App\Models\Penjualan::with([
            'pelanggan', // relasi ke model Pelanggan
            'metodeBayar',
            'details.obat'
        ])
        ->orderBy('created_at', 'desc')
        ->paginate(5);

        return view('be.penjualan.index', compact('penjualan'));
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

    /**
     * Approve the specified penjualan.
     */
    public function approve($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->update([
            'status_order' => 'Diproses',
            'keterangan_status' => 'Pesanan disetujui oleh kasir'
        ]);
        return redirect()->back()->with('success', 'Pesanan berhasil disetujui');
    }

    /**
     * Reject the specified penjualan.
     */
    public function reject($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->update([
            'status_order' => 'Dibatalkan penjual',
            'keterangan_status' => 'Pesanan ditolak oleh kasir'
        ]);
        return redirect()->back()->with('success', 'Pesanan ditolak');
    }

    /**
     * Update the status description of the specified penjualan.
     */
    public function updateKeterangan(Request $request, $id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->update([
            'keterangan_status' => $request->keterangan_status
        ]);

        return redirect()->back()->with('success', 'Keterangan status berhasil diperbarui');
    }
}
