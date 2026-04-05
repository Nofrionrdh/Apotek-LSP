<?php

namespace Database\Seeders;

use App\Models\Distributor;
use Illuminate\Database\Seeder;

class DistributorSeeder extends Seeder
{
    public function run(): void
    {
        $distributors = [
            [
                'nama_distributor' => 'PT Kimia Farma',
                'telepon' => '021-4567890',
                'alamat' => 'Jl. Veteran No. 10, Jakarta'
            ],
            [
                'nama_distributor' => 'PT Kalbe Farma',
                'telepon' => '021-5678901',
                'alamat' => 'Jl. Jenderal Sudirman No. 15, Jakarta'
            ],
            [
                'nama_distributor' => 'PT Sanbe Farma',
                'telepon' => '022-6789012',
                'alamat' => 'Jl. Asia Afrika No. 20, Bandung'
            ]
        ];

        foreach ($distributors as $distributor) {
            Distributor::create($distributor);
        }
    }
}
