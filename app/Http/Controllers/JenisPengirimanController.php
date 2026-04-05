<?php

namespace App\Http\Controllers;

use App\Models\JenisPengiriman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JenisPengirimanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenis_pengirimans = \App\Models\JenisPengiriman::orderBy('jenis_kirim')->paginate(5);
        return view('be.jenis-pengiriman.index', compact('jenis_pengirimans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('be.jenis-pengiriman.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_kirim' => 'required|string|max:50',
            'nama_ekspedisi' => 'required|string|max:50',
            'ongkos_kirim' => 'required|numeric|min:0',
            'logo_ekspedisi' => 'nullable|image|max:2048',
        ]);

        $logo = null;
        if ($request->hasFile('logo_ekspedisi')) {
            $logo = $request->file('logo_ekspedisi')->store('logo_ekspedisi', 'public');
        }

        JenisPengiriman::create([
            'jenis_kirim' => $request->jenis_kirim,
            'nama_ekspedisi' => $request->nama_ekspedisi,
            'ongkos_kirim' => $request->ongkos_kirim,
            'logo_ekspedisi' => $logo,
        ]);

        return redirect()->route('jenis-pengiriman.index')->with('success', 'Jenis pengiriman berhasil ditambahkan.');
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
        $jenis_pengiriman = JenisPengiriman::findOrFail($id);
        return view('be.jenis-pengiriman.edit', compact('jenis_pengiriman'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $jenis_pengiriman = JenisPengiriman::findOrFail($id);

        $request->validate([
            'jenis_kirim' => 'required|string|max:50',
            'nama_ekspedisi' => 'required|string|max:50',
            'ongkos_kirim' => 'required|numeric|min:0',
            'logo_ekspedisi' => 'nullable|image|max:2048',
        ]);

        $data = [
            'jenis_kirim' => $request->jenis_kirim,
            'nama_ekspedisi' => $request->nama_ekspedisi,
            'ongkos_kirim' => $request->ongkos_kirim,
        ];

        if ($request->hasFile('logo_ekspedisi')) {
            $data['logo_ekspedisi'] = $request->file('logo_ekspedisi')->store('logo_ekspedisi', 'public');
        }

        $jenis_pengiriman->update($data);

        return redirect()->route('jenis-pengiriman.index')->with('success', 'Jenis pengiriman berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jenis_pengiriman = JenisPengiriman::findOrFail($id);
        
        // Hapus file logo dari storage
        if($jenis_pengiriman->logo_ekspedisi) {
            Storage::disk('public')->delete($jenis_pengiriman->logo_ekspedisi);
        }
        
        $jenis_pengiriman->delete();
        return redirect()->route('jenis-pengiriman.index')->with('success', 'Jenis pengiriman berhasil dihapus.');
    }
}
