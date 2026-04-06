<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OngkirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
     * Calculate cost via RajaOngkir API.
     */
    public function calculateCost(Request $request)
    {
        $request->validate([
            'destination' => 'required',
            'weight' => 'nullable|integer',
            'courier' => 'nullable|string'
        ]);

        $origin = config('rajaongkir.origin_city_id');
        if (! $origin) {
            return response()->json(['error' => 'RAJAONGKIR_ORIGIN_CITY_ID not configured in .env'], 400);
        }

        $destination = $request->input('destination');
        $weight = $request->input('weight', 1000);
        $courier = $request->input('courier', 'jne');

        $url = rtrim(config('rajaongkir.url', 'https://api.rajaongkir.com/starter/'), '/') . '/cost';

        try {
            $res = Http::withHeaders([
                'key' => config('rajaongkir.api_key')
            ])->post($url, [
                'origin' => $origin,
                'destination' => $destination,
                'weight' => $weight,
                'courier' => $courier
            ]);

            if ($res->failed()) {
                return response()->json(['error' => 'RajaOngkir request failed', 'body' => $res->body()], 500);
            }

            return response()->json($res->json());
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

