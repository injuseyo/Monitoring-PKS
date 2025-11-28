<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aktivitas extends Model
{
    protected $table = 'activities';

    protected $fillable = [
        'karyawan_id',   // ganti dari user_id
        'pekerjaan_id',  // ganti dari jabatan_id
        'judul',
        'deskripsi',
        'foto',
        'tanggal',
        'waktu',
        'created_at',
        'updated_at'
    ];

    // Tambahkan relationship yang dibutuhkan controller
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }

    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class, 'pekerjaan_id');
    }

    // Keep existing relationships jika masih dipakai
    public function user()
    {
        return $this->belongsTo(User::class, 'karyawan_id'); // alias ke karyawan
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'pekerjaan_id'); // alias ke pekerjaan
    }
}