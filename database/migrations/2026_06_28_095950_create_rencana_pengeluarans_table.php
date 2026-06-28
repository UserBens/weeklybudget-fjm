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
        Schema::create('rencana_pengeluarans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_input');
            $table->tinyInteger('bulan');           // 1–12
            $table->tinyInteger('minggu');          // 1–4
            $table->string('kategori');             // nama kategori langsung (tidak FK dulu)
            $table->enum('tipe', ['BAPP', 'Uang Muka']);
            $table->string('dibayarkan_kepada');
            $table->text('keterangan')->nullable();
            $table->bigInteger('nominal');          // dalam rupiah (tanpa desimal)
            $table->string('no_dokumen')->nullable();
            $table->unsignedBigInteger('created_by')->nullable(); // user id
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rencana_pengeluarans');
    }
};
