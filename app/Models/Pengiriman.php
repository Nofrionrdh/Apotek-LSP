<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory;

    protected $table = 'pengirimans';

    protected $fillable = [
        'id_penjualan',
        'no_invoice',
        'no_resi',
        'tgl_kirim',
        'tgl_tiba', 
        'status_kirim',
        'nama_kurir',
        'telpon_kurir',
        'bukti_foto',
        'keterangan'
    ];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'id_penjualan');
    }
}
