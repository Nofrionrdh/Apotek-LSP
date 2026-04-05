<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManageUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = \App\Models\User::orderBy('name')->paginate(5);
        return view('be.manage-user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('be.manage-user.create', [
            'title' => 'Tambah User'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'jabatan' => 'required|in:admin,apoteker,karyawan,kasir,pemilik,kurir', // Tambahkan kurir
        ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'jabatan' => $request->jabatan,
                'aktif' => 1,
            ]);

            return redirect()->route('manage-user.index')
                ->with('success', 'User berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->withInput()
                ->withErrors(['error' => 'Gagal menambahkan user: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('be.manage-user.show', [
            'title' => 'User Details',
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('be.manage-user.edit', [
            'title' => 'Edit User',
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'jabatan' => 'required|in:admin,apoteker,karyawan,kasir,pemilik,kurir',
            'password' => 'nullable|min:6', // Optional password change
        ]);

        try {
            $userData = [
                'name' => $request->name,
                'email' => $request->email,
                'jabatan' => $request->jabatan,
            ];

            // Only update password if provided
            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }

            $user->update($userData);

            return redirect()->route('manage-user.index')
                ->with('success', 'User berhasil diupdate');
        } catch (\Exception $e) {
            return back()->withInput()
                ->withErrors(['error' => 'Gagal mengupdate user: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/manage-user')->with('success', 'User berhasil dihapus');
    }
}
