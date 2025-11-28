<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aktivitas; // Ganti dari Activity
use App\Models\Jabatan;
use App\Models\User;
use App\Models\Karyawan; // Tambahkan
use App\Models\Pekerjaan; // Tambahkan
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ArsipController extends Controller
{
    public function index()
    {
        // Grafik Line: Total Aktivitas per Hari
        $aktivitasPerHari = Aktivitas::selectRaw('tanggal, COUNT(*) as total')
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        $lineLabels = $aktivitasPerHari->pluck('tanggal')->map(function($tgl){
            return Carbon::parse($tgl)->format('d-m-Y');
        })->toArray();
        $lineData = $aktivitasPerHari->pluck('total')->toArray();

        // Grafik Pie: Distribusi Jobdesk/Pekerjaan
        $jobdeskDistribusi = Aktivitas::selectRaw('pekerjaan_id, COUNT(*) as total')
            ->groupBy('pekerjaan_id')
            ->get();

        $pieLabels = [];
        $pieData = [];
        foreach ($jobdeskDistribusi as $row) {
            $pekerjaan = Pekerjaan::find($row->pekerjaan_id);
            $pieLabels[] = $pekerjaan ? $pekerjaan->nama : 'Unknown';
            $pieData[] = $row->total;
        }

        // Tabel Aktivitas Karyawan dengan ringkasan per karyawan
        $aktivitasKaryawan = Aktivitas::selectRaw('karyawan_id, pekerjaan_id, COUNT(*) as total_aktivitas, MAX(tanggal) as terakhir_aktivitas')
            ->with(['karyawan', 'pekerjaan'])
            ->groupBy('karyawan_id', 'pekerjaan_id')
            ->orderBy('total_aktivitas', 'desc')
            ->get();

        // Hitung total aktivitas
        $totalAktivitas = Aktivitas::count();
        $aktivitasHariIni = Aktivitas::whereDate('tanggal', today())->count();
        $aktivitasMingguIni = Aktivitas::whereBetween('tanggal', [now()->startOfWeek(), now()->endOfWeek()])->count();

        return view('arsip', [
            'lineLabels' => $lineLabels,
            'lineData' => $lineData,
            'pieLabels' => $pieLabels,
            'pieData' => $pieData,
            'aktivitasKaryawan' => $aktivitasKaryawan,
            'totalAktivitas' => $totalAktivitas,
            'aktivitasHariIni' => $aktivitasHariIni,
            'aktivitasMingguIni' => $aktivitasMingguIni,
        ]);
    }
}