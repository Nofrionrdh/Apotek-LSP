<?php

namespace Database\Seeders;

use App\Models\JenisPengiriman;
use Illuminate\Database\Seeder;

class JenisPengirimanSeeder extends Seeder
{
    public function run(): void
    {
        $shippings = [
            [
                'jenis_kirim' => 'regular',
                'nama_ekspedisi' => 'Ninja Express',
                'ongkos_kirim' => 10000,
                'logo_ekspedisi' => 'be/assets/img/ninja-express.jpg'
            ],
            [
                'jenis_kirim' => 'ekonomi',
                'nama_ekspedisi' => 'JNT',
                'ongkos_kirim' => 8000,
                'logo_ekspedisi' => 'be/assets/img/jnt.jpg'
            ],
            [
                'jenis_kirim' => 'same day',
                'nama_ekspedisi' => 'SiCepat',
                'ongkos_kirim' => 25000,
                'logo_ekspedisi' => 'be/assets/img/sicepat.png'
            ],
            [
                'jenis_kirim' => 'kargo',
                'nama_ekspedisi' => 'JNE',
                'ongkos_kirim' => 20000,
                'logo_ekspedisi' => 'be/assets/img/jne.jpg'
            ],
            [
                'jenis_kirim' => 'Standard',
                'nama_ekspedisi' => 'TIKI',
                'ongkos_kirim' => 10000,
                'logo_ekspedisi' => 'be/assets/img/Logo-TIKI.png'
            ]
        ];

        foreach ($shippings as $shipping) {
            JenisPengiriman::create($shipping);
        }
    }
}
