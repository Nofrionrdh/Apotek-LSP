<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin1',
            'email' => 'admin@gmail.com',
            'password' => '12345678',
            'jabatan' => 'admin'
        ]);

        User::create([
            'name' => 'Kasir1',
            'email' => 'kasir@gmail.com',
            'password' => '12345678',
            'jabatan' => 'kasir'
        ]);
        User::create([
            'name' => 'Apoteker1',
            'email' => 'apoteker@gmail.com',
            'password' => '12345678',
            'jabatan' => 'Apoteker'
        ]);
        User::create([
            'name' => 'Karyawan1',
            'email' => 'karyawan@gmail.com',
            'password' => '12345678',
            'jabatan' => 'Karyawan'
        ]);
        User::create([
            'name' => 'Pemilik1',
            'email' => 'pemilik@gmail.com',
            'password' => '12345678',
            'jabatan' => 'Pemilik'
        ]);
        User::create([
            'name' => 'Kurir1',
            'email' => 'kurir@gmail.com',
            'password' => '12345678',
            'jabatan' => 'Kurir'
        ]);
        User::create([
            'name' => 'Kurir2',
            'email' => 'Kurir2@gmail.com',
            'password' => '12345678',
            'jabatan' => 'Kurir'
        ]);
    }
}
