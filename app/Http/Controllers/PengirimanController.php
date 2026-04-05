<?php

namespace App\Http\Controllers;

use App\Models\Pengiriman;
use App\Models\Penjualan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PengirimanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengirimans = Pengiriman::with('penjualan')->latest()->paginate(5);
        return view('be.pengiriman.index', compact('pengirimans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $penjualans = Penjualan::with('pelanggan')
                        ->where('status_order', 'Diproses')
                        ->get();
        $kurirs = User::where('jabatan', 'kurir')->get();
        return view('be.pengiriman.create', compact('penjualans', 'kurirs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_penjualan' => 'required|exists:penjualans,id',
            'no_invoice' => 'required|unique:pengirimans,no_invoice',
            'tgl_kirim' => 'required|date',
            'tgl_tiba' => 'required|date|after_or_equal:tgl_kirim',
            'status_kirim' => 'required|in:Sedang Dikirim,Tiba Ditujuan',
            'nama_kurir' => 'required', // validasi tetap, tapi sekarang value dari dropdown
            'telpon_kurir' => 'required|max:15',
            'bukti_foto' => 'required|image|max:2048',
            'keterangan' => 'nullable',
        ]);

        DB::beginTransaction();
        try {
            $buktiFoto = null;
            if ($request->hasFile('bukti_foto')) {
                $buktiFoto = $request->file('bukti_foto')->store('bukti_pengiriman', 'public');
            }

            $noResi = 'RESI-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));

            $pengiriman = Pengiriman::create([
                'id_penjualan' => $request->id_penjualan,
                'no_invoice' => $request->no_invoice,
                'no_resi' => $noResi,
                'tgl_kirim' => $request->tgl_kirim,
                'tgl_tiba' => $request->tgl_tiba,
                'status_kirim' => $request->status_kirim,
                'nama_kurir' => $request->nama_kurir,
                'telpon_kurir' => $request->telpon_kurir,
                'bukti_foto' => $buktiFoto,
                'keterangan' => $request->keterangan,
            ]);

            DB::commit();
            return redirect()->route('pengiriman.index')->with('success', 'Data pengiriman berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            // \Log::error('Pengiriman Store Error: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data pengiriman: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pengiriman = Pengiriman::with('penjualan')->findOrFail($id);
        return view('be.pengiriman.show', compact('pengiriman'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pengiriman = Pengiriman::findOrFail($id);
        $penjualans = Penjualan::all();
        return view('be.pengiriman.edit', compact('pengiriman', 'penjualans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pengiriman = Pengiriman::findOrFail($id);

        $request->validate([
            'id_penjualan' => 'required|exists:penjualans,id',
            'no_invoice' => 'required|unique:pengirimans,no_invoice,' . $pengiriman->id,
            'tgl_kirim' => 'required|date',
            'tgl_tiba' => 'required|date|after_or_equal:tgl_kirim',
            'status_kirim' => 'required|in:Sedang Dikirim,Tiba Ditujuan',
            'nama_kurir' => 'required|max:30',
            'telpon_kurir' => 'required|max:15',
            'bukti_foto' => 'nullable|image|max:2048',
            'keterangan' => 'nullable',
        ]);

        $data = $request->only([
            'id_penjualan', 'no_invoice', 'tgl_kirim', 'tgl_tiba', 'status_kirim',
            'nama_kurir', 'telpon_kurir', 'keterangan'
        ]);

        if ($request->hasFile('bukti_foto')) {
            $data['bukti_foto'] = $request->file('bukti_foto')->store('bukti_pengiriman', 'public');
        }

        $pengiriman->update($data);

        return redirect()->route('pengiriman.index')->with('success', 'Data pengiriman berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pengiriman = Pengiriman::findOrFail($id);
        
        // Hapus file bukti foto dari storage
        if($pengiriman->bukti_foto) {
            Storage::disk('public')->delete($pengiriman->bukti_foto);
        }
        
        $pengiriman->delete();
        return redirect()->route('pengiriman.index')->with('success', 'Data pengiriman berhasil dihapus.');
    }

    /**
     * Update status order penjualan to 'Menunggu Kurir'.
     */
    public function setMenungguKurir($id)
    {
        $pengiriman = Pengiriman::findOrFail($id);
        $penjualan = $pengiriman->penjualan;
        if ($penjualan) {
            $penjualan->status_order = 'Menunggu Kurir';
            $penjualan->save();
            return redirect()->route('pengiriman.index')->with('success', 'Status order penjualan diubah menjadi Menunggu Kurir.');
        }
        return redirect()->route('pengiriman.index')->with('error', 'Penjualan tidak ditemukan.');
    }
}
