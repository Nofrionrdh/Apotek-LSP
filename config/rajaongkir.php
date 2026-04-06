<?php 

    return [
        'api_key' => env('RAJAONGKIR_API_KEY', ''),
        'url' => env('RAJAONGKIR_URL', 'https://api.rajaongkir.com/starter/'),
        // Set origin city id (kota id) for your store (example: Jakarta = 166)
        'origin_city_id' => env('RAJAONGKIR_ORIGIN_CITY_ID', '')
    ];

?>