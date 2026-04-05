<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MetodeBayar;

class MetodePembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $metodes = \App\Models\MetodeBayar::orderBy('metode_pembayaran')->paginate(5);
        return view('be.metode-bayar.index', compact('metodes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('be.metode-bayar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'metode_pembayaran' => 'required|string|max:30',
            'tempat_bayar' => 'required|string|max:50',
            'no_rekening' => 'required|string|max:25',
            'url_logo' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
        ]);

        $logoPath = null;
        if ($request->hasFile('url_logo')) {
            $logoPath = $request->file('url_logo')->store('metode_logo', 'public');
        }

        MetodeBayar::create([
            'metode_pembayaran' => $request->metode_pembayaran,
            'tempat_bayar' => $request->tempat_bayar,
            'no_rekening' => $request->no_rekening,
            'url_logo' => $logoPath,
        ]);
        return redirect()->route('metode-bayar.index')->with('success', 'Metode pembayaran berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $metode = MetodeBayar::findOrFail($id);
        return view('be.metode-bayar.show', compact('metode'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $metode = MetodeBayar::findOrFail($id);
        return view('be.metode-bayar.edit', compact('metode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'metode_pembayaran' => 'required|string|max:30',
            'tempat_bayar' => 'required|string|max:50',
            'no_rekening' => 'required|string|max:25',
            'url_logo' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
        ]);
        $metode = MetodeBayar::findOrFail($id);

        $logoPath = $metode->url_logo;
        if ($request->hasFile('url_logo')) {
            $logoPath = $request->file('url_logo')->store('metode_logo', 'public');
        }

        $metode->update([
            'metode_pembayaran' => $request->metode_pembayaran,
            'tempat_bayar' => $request->tempat_bayar,
            'no_rekening' => $request->no_rekening,
            'url_logo' => $logoPath,
        ]);
        return redirect()->route('metode-bayar.index')->with('success', 'Metode pembayaran berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $metode = MetodeBayar::findOrFail($id);
        $metode->delete();
        return redirect()->route('metode-bayar.index')->with('success', 'Metode pembayaran berhasil dihapus.');
    }
}
