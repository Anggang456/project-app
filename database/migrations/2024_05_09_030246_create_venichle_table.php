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
        Schema::create('venichle', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 20);
            $table->enum('type', ['Angkutan Orang', 'Angkutan Barang']);
            $table->string('nomor', 10);
            $table->integer('bbm');
            $table->date('service');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venichle');
    }
};
