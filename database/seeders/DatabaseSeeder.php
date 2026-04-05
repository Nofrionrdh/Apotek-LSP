<?php

namespace Database\Seeders;

use App\Models\JenisObat;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            PelangganSeeder::class,
            JenisObatSeeder::class,
            JenisPengirimanSeeder::class,
            DistributorSeeder::class,
        ]);
    }
}
