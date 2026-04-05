<?php

namespace Database\Seeders;

use App\Models\JenisObat;
use Illuminate\Database\Seeder;

class JenisObatSeeder extends Seeder
{
    public function run(): void
    {
        JenisObat::create([
            'jenis' => 'Obat Bebas',
            'deskripsi_jenis' => 'Obat yang dapat dibeli tanpa resep dokter',
            'image_url' => 'be/img/obat-bebas.png'
        ]);

        JenisObat::create([
            'jenis' => 'Obat Keras',
            'deskripsi_jenis' => 'Obat yang hanya bisa dibeli dengan resep dokter',
            'image_url' => 'be/img/obat-keras.png'
        ]);

        JenisObat::create([
            'jenis' => 'Obat Bebas Terbatas',
            'deskripsi_jenis' => 'Obat yang dapat dibeli bebas namun dengan jumlah terbatas',
            'image_url' => 'be/img/obat-bebas-terbatas.png'
        ]);
    }
}