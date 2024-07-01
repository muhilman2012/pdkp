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
        Schema::create('permintaan', function (Blueprint $table) {
            $table->id('id_permintaan');
            $table->string('waktu');
            $table->string('keperluan');
            $table->string('pengguna');
            $table->string('phone');
            $table->string('jam_awal');
            $table->string('jam_akhir');
            $table->date('date');
            $table->string('tujuan_awal');
            $table->string('tujuan_akhir');
            $table->string('file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permintaan');
    }
};
