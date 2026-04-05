<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Pelanggan;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelanggan = session('pelanggan');
        if (!$pelanggan) {
            return redirect()->route('pelanggan.login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Get orders with relationships
        $penjualans = Penjualan::with(['metodeBayar', 'jenisKirim', 'details.obat'])
            ->where('id_pelanggan', $pelanggan->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('fe.pemesanan.index', compact('penjualans'));
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
    public function destroy($id)
    {
        try {
            $pelanggan = session('pelanggan');
            if (!$pelanggan) {
                return redirect()->route('pelanggan.login')
                    ->with('error', 'Silakan login terlebih dahulu.');
            }

            $penjualan = Penjualan::where('id', $id)
                ->where('id_pelanggan', $pelanggan->id)
                ->first();

            if (!$penjualan) {
                return redirect()->back()
                    ->with('error', 'Pesanan tidak ditemukan.');
            }

            if (!in_array($penjualan->status_order, ['Dibatalkan Pembeli', 'Dibatalkan Penjual'])) {
                return redirect()->back()
                    ->with('error', 'Hanya pesanan yang dibatalkan yang dapat dihapus.');
            }

            // Delete related details first
            $penjualan->details()->delete();
            // Then delete the order
            $penjualan->delete();

            return redirect()->back()
                ->with('success', 'Pesanan berhasil dihapus.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    public function cancel($id)
    {
        try {
            $pelanggan = session('pelanggan');
            if (!$pelanggan) {
                return redirect()->route('pelanggan.login')
                    ->with('error', 'Silakan login terlebih dahulu.');
            }

            $penjualan = Penjualan::where('id', $id)
                ->where('id_pelanggan', $pelanggan->id)
                ->first();

            if (!$penjualan) {
                return redirect()->back()
                    ->with('error', 'Pesanan tidak ditemukan.');
            }

            if (!in_array($penjualan->status_order, ['Menunggu Konfirmasi', 'Diproses'])) {
                return redirect()->back()
                    ->with('error', 'Status pesanan tidak dapat dibatalkan.');
            }

            $penjualan->update([
                'status_order' => 'Dibatalkan Pembeli',
                'keterangan_status' => 'Dibatalkan oleh pembeli'
            ]);

            return redirect()->back()
                ->with('success', 'Pesanan berhasil dibatalkan.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
