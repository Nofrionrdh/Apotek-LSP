<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('jenis_pengirimans', function (Blueprint $table) {
            $table->id(); // kolom id bigint(20) unsigned
            $table->enum('jenis_kirim', ['ekonomi', 'kargo', 'regular', 'same day', 'standard']);
            $table->string('nama_ekspedisi');
            $table->string('ongkos_kirim');
            $table->string('logo_ekspedisi');
            $table->timestamps(); // kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_pengirimans');
    }
};
