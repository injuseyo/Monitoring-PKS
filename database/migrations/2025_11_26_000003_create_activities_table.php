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
    Schema::create('activities', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
        $table->foreignId('jabatan_id')->constrained('jabatan')->cascadeOnDelete();
        $table->string('judul', 150);
        $table->text('deskripsi')->nullable();
        $table->string('foto', 255)->nullable();
        $table->date('tanggal');
        $table->time('waktu');
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('activities');
}

};
