<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class TestRajaOngkirController extends Controller
{
    public function testCouriers()
    {
        $destination = 1; // NTB
        $origin = 501; // Jakarta
        $apiKey = config('rajaongkir.api_key');

        echo "Testing Raja Ongkir API<br>";
        echo "Origin: $origin (Jakarta)<br>";
        echo "Destination: $destination (NTB)<br>";
        echo "API Key: " . substr($apiKey, 0, 10) . "...<br><br>";

        try {
            $response = Http::withHeaders([
                'key' => $apiKey,
            ])->timeout(10)->post('https://rajaongkir.komerce.id/api/v1/cost', [
                'origin' => $origin,
                'destination' => $destination,
                'weight' => 1000,
                'courier' => 'jne:tiki:pos'
            ]);

            echo "Status: " . $response->status() . "<br>";
            echo "<pre>";
            echo json_encode($response->json(), JSON_PRETTY_PRINT);
            echo "</pre>";
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function testCost()
    {
        $destination = 1;
        $origin = 501;
        $courier = 'jne';
        $weight = 1000;
        $apiKey = config('rajaongkir.api_key');

        echo "Testing Raja Ongkir Cost API<br>";
        echo "Origin: $origin<br>";
        echo "Destination: $destination<br>";
        echo "Courier: $courier<br>";
        echo "Weight: $weight<br><br>";

        try {
            $response = Http::withHeaders([
                'key' => $apiKey,
            ])->timeout(10)->post('https://rajaongkir.komerce.id/api/v1/cost', [
                'origin' => $origin,
                'destination' => $destination,
                'weight' => $weight,
                'courier' => $courier
            ]);

            echo "Status: " . $response->status() . "<br>";
            echo "<pre>";
            echo json_encode($response->json(), JSON_PRETTY_PRINT);
            echo "</pre>";
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
