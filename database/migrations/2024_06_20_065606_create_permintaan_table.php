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
            $table->uuid('id_permintaan')->primary(); // Tetapkan primary key
            $table->string('uuid', 10)->unique(); // Tambahkan kolom uuid dengan panjang 10 karakter
            $table->string('layanan');
            $table->string('waktu');
            $table->string('keperluan');
            $table->string('pengguna');
            $table->string('phone');
            $table->integer('capacity'); // Ubah ke integer jika kapasitas adalah angka
            $table->string('tipe_perjalanan');
            $table->time('jam_awal');
            $table->time('jam_akhir')->nullable();
            $table->date('date');
            $table->string('tujuan_awal');
            $table->string('tujuan_akhir');
            $table->string('file')->nullable();
            $table->unsignedBigInteger('pengemudi_id')->nullable(); // Tambahkan nullable jika pengemudi_id bisa kosong
            $table->foreign('pengemudi_id')->references('id')->on('pengemudi');
            $table->string('kendaraan_id')->nullable();
            $table->string('nopol')->nullable();
            $table->string('warna')->nullable();
            $table->string('status');
            $table->timestamp('status_update')->nullable();
            $table->string('rating_ops')->nullable();
            $table->string('rating_driver')->nullable();
            $table->string('review')->nullable();
            $table->string('pesan')->nullable();
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