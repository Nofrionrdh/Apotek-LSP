<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Distributor;

class Pembelian extends Model
{
    use HasFactory;

    protected $table = 'pembelians';

    protected $fillable = [
        'no_nota',
        'tgl_pembelian',
        'total_bayar',
        'id_distributor',
    ];

    // Relasi contoh (kalau sudah buat model lain)
    public function distributor()
    {
        return $this->belongsTo(Distributor::class, 'id_distributor');
    }

    public function details()
    {
        return $this->hasMany(\App\Models\DetailPembelian::class, 'id_pembelian');
    }

    public function obat()
    {
        return $this->hasManyThrough(
            Obat::class,
            DetailPembelian::class,
            'id_pembelian', // Foreign key on detail_pembelians table
            'id', // Foreign key on obats table
            'id', // Local key on pembelians table
            'id_obat' // Local key on detail_pembelians table
        );
    }
}
