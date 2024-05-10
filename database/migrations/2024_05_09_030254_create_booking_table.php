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
        Schema::create('booking', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('atasan_1');
            $table->foreign('atasan_1')->references('id')->on('users');
            $table->unsignedBigInteger('atasan_2');
            $table->foreign('atasan_2')->references('id')->on('users');
            $table->unsignedBigInteger('driver_id');
            $table->foreign('driver_id')->references('id')->on('driver');
            $table->unsignedBigInteger('venichle_id');
            $table->foreign('venichle_id')->references('id')->on('venichle');
            $table->string('nama');
            $table->string('telp');
            $table->date('tgl_pesan');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->integer('konsumsi');
            $table->enum('status', ['Menunggu Persetujuan','Disetujui', 'Ditolak']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};
