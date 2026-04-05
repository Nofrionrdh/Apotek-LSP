<?php

namespace Database\Seeders;

use App\Models\Pelanggan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class PelangganSeeder extends Seeder
{
    public function run(): void
    {
        Pelanggan::create([
                'nama_pelanggan' => 'Pelanggan1',
                'email' => 'pelanggan@gmail.com',
                'katakunci' => '12345678',
                'no_telp' => '08123456789',
                'alamat1' => 'Jl. Raya No. 1',
                'kota1' => 'Jakarta',
                'propinsi1' => 'DKI Jakarta',
                'kodepos1' => '12345',
            ]);
         Pelanggan::create([
                'nama_pelanggan' => 'Pelanggan2',
                'email' => 'pelanggan2@gmail.com',
                'katakunci' => '12345678',
                'no_telp' => '08123456798',
                'alamat1' => 'Jl. Raya No. 2',
                'kota1' => 'Jakarta',
                'propinsi1' => 'DKI Jakarta',
                'kodepos1' => '54321',
            ]);
    }
}
