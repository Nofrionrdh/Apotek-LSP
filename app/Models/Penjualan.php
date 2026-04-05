<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MetodeBayar;
use App\Models\JenisPengiriman;
use App\Models\Pelanggan;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualans'; // Kalau nama tabel beda dari default Laravel

    protected $fillable = [
        'id_metode_bayar',
        'tgl_penjualan',
        'url_resep',
        'ongkos_kirim',
        'biaya_app',
        'total_bayar',
        'status_order',
        'keterangan_status',
        'id_jenis_kirim',
        'id_pelanggan',
        'no_pemesanan',
    ];

    // Relasi contoh (kalau sudah buat model lain)
    public function metodeBayar()
    {
        return $this->belongsTo(MetodeBayar::class, 'id_metode_bayar');
    }

    public function jenisKirim()
    {
        return $this->belongsTo(JenisPengiriman::class, 'id_jenis_kirim');
    }

    public function pelanggan()
    {
        return $this->belongsTo(\App\Models\Pelanggan::class, 'id_pelanggan');
    }

    public function pengiriman()
    {
        return $this->hasOne(Pengiriman::class, 'id_penjualan');
    }
    
    public function details()
    {
        return $this->hasMany(DetailPenjualan::class, 'id_penjualan');
    }
}
