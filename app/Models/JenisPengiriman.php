<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPengiriman extends Model
{
    use HasFactory;

    protected $table = 'jenis_pengirimans';

    protected $fillable = [
        'jenis_kirim',
        'nama_ekspedisi',
        'ongkos_kirim',
        'logo_ekspedisi',
    ];

    // Definisikan ENUM jenis pengiriman
    public static function jenisKirimList()
    {
        return [
            'ekonomi' => 'Ekonomi',
            'kargo' => 'Kargo', 
            'regular' => 'Regular',
            'same day' => 'Same Day',
            'standard' => 'Standard'
        ];
    }
}
