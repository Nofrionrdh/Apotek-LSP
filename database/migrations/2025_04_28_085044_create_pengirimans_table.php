<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengirimans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_penjualan');
            $table->foreign('id_penjualan')->references('id')->on('penjualans')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->string('no_invoice')->unique();
            $table->string('no_resi')->unique();
            $table->dateTime('tgl_kirim'); 
            $table->dateTime('tgl_tiba');
            $table->enum('status_kirim', ['Sedang Dikirim', 'Tiba Ditujuan']);
            $table->string('nama_kurir', 30); 
            $table->string('telpon_kurir', 15); 
            $table->string('bukti_foto'); 
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengirimans');
    }
};
