<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RajaOngkirController extends Controller
{
    /**
     * Menampilkan daftar provinsi dari API Raja Ongkir
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mengambil data provinsi dari API Raja Ongkir
        $response = Http::withHeaders([

            //headers yang diperlukan untuk API Raja Ongkir
            'Accept' => 'application/json',
            'key' => config('rajaongkir.api_key'),

        ])->get('https://rajaongkir.komerce.id/api/v1/destination/province');

        // Memeriksa apakah permintaan berhasil
        if ($response->successful()) {

            // Mengambil data provinsi dari respons JSON
            // Jika 'data' tidak ada, inisialisasi dengan array kosong
            $provinces = $response->json()['data'] ?? [];
        }

        // returning the view with provinces data
        return view('rajaongkir', compact('provinces'));
    }
}
