<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aktivitas', function (Blueprint $table) {
            $table->id();

            // relasi ke karyawan & pekerjaan
            $table->foreignId('karyawan_id')
                  ->constrained('karyawans')
                  ->onDelete('cascade');

            $table->foreignId('pekerjaan_id')
                  ->constrained('pekerjaans')
                  ->onDelete('cascade');

            $table->string('deskripsi');
            $table->date('tanggal');
            $table->string('waktu');      // contoh: "07.00"
            $table->string('foto_path')->nullable(); // kalau nanti pakai foto

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aktivitas');
    }
};
