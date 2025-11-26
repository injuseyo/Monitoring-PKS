<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jabatan;

class JabatanSeeder extends Seeder
{
    public function run(): void
    {
        Jabatan::insert([
            ['nama_jabatan' => 'Manager', 'deskripsi' => 'Mengawasi operasional harian'],
            ['nama_jabatan' => 'Staff IT', 'deskripsi' => 'Menangani kebutuhan IT kantor'],
            ['nama_jabatan' => 'Admin', 'deskripsi' => 'Mengurus dokumen dan administrasi'],
            ['nama_jabatan' => 'Marketing', 'deskripsi' => 'Mengelola kampanye pemasaran'],
        ]);
    }
}
