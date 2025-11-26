<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activity;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        Activity::insert([
            [
                'user_id' => 1,
                'jabatan_id' => 1,
                'judul' => 'Rapat Koordinasi Mingguan',
                'deskripsi' => 'Evaluasi kinerja tim dan target operasional.',
                'foto' => 'rapat1.jpg',
                'tanggal' => '2025-02-01',
                'waktu' => '09:00:00',
            ],
            [
                'user_id' => 2,
                'jabatan_id' => 2,
                'judul' => 'Maintenance Server',
                'deskripsi' => 'Pengecekan server, update, dan backup.',
                'foto' => 'server_maint.jpg',
                'tanggal' => '2025-02-02',
                'waktu' => '10:30:00',
            ],
            [
                'user_id' => 3,
                'jabatan_id' => 3,
                'judul' => 'Pengarsipan Dokumen',
                'deskripsi' => 'Mengarsip dokumen bulanan sesuai SOP.',
                'foto' => 'dokumen.jpg',
                'tanggal' => '2025-02-03',
                'waktu' => '14:00:00',
            ],
        ]);
    }
}
