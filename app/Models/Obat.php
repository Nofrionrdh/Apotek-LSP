<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JenisObat;

class Obat extends Model
{
    use HasFactory;

    protected $table = 'obats';

    protected $fillable = [
        'nama_obat',
        'id_jenis',
        'harga_jual',
        'deskripsi_obat',
        'foto1',
        'foto2',
        'foto3',
        'stok',
    ];

    // Relasi

    public function jenis_obat()
    {
        return $this->belongsTo(JenisObat::class, 'id_jenis');
    }

    public function jenisObat()
    {
        return $this->belongsTo(JenisObat::class, 'id_jenis');
    }
}
