<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Distributor;

class DistributorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $distributors = \App\Models\Distributor::orderBy('nama_distributor')->paginate(5);
        return view('be.distributor.index', compact('distributors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('be.distributor.create', [
            'title' => 'Tambah distributor'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_distributor' => 'required|string|max:50',
            'telepon' => 'required|string|max:15',
            'alamat' => 'required|string'
        ]);

        Distributor::create([
            'nama_distributor' => $request->nama_distributor,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat
        ]);

        return redirect('/distributor')->with('success', 'Distributor berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $distributor = Distributor::findOrFail($id);
        return view('be.distributor.show', [
            'title' => 'Detail distributor',
            'distributor' => $distributor
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $distributor = Distributor::findOrFail($id);
        return view('be.distributor.edit', [
            'title' => 'Edit distributor',
            'distributor' => $distributor
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_distributor' => 'required|string|max:50',
            'telepon' => 'required|string|max:15',
            'alamat' => 'required|string'
        ]);

        $distributor = Distributor::findOrFail($id);
        $distributor->update([
            'nama_distributor' => $request->nama_distributor,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat
        ]);

        return redirect('/distributor')->with('success', 'Distributor berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $distributor = Distributor::findOrFail($id);
        $distributor->delete();
        return redirect('/distributor')->with('success', 'Distributor berhasil dihapus');
    }
}
