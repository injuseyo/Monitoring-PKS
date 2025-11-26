<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Jabatan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ArsipController extends Controller
{
    public function index()
    {
        // Grafik Line: Total Aktivitas per Hari
        $aktivitasPerHari = Activity::selectRaw('tanggal, COUNT(*) as total')
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        $lineLabels = $aktivitasPerHari->pluck('tanggal')->map(function($tgl){
            return Carbon::parse($tgl)->format('d-m-Y');
        })->toArray();
        $lineData = $aktivitasPerHari->pluck('total')->toArray();

        // Grafik Pie: Distribusi Jobdesk/Jabatan
        $jobdeskDistribusi = Activity::selectRaw('jabatan_id, COUNT(*) as total')
            ->groupBy('jabatan_id')
            ->get();

        $pieLabels = [];
        $pieData = [];
        foreach ($jobdeskDistribusi as $row) {
            $jabatan = Jabatan::find($row->jabatan_id);
            $pieLabels[] = $jabatan ? $jabatan->nama_jabatan : 'Unknown';
            $pieData[] = $row->total;
        }

        // Tabel Aktivitas Karyawan dengan ringkasan per user
        $aktivitasKaryawan = Activity::selectRaw('user_id, jabatan_id, COUNT(*) as total_aktivitas, MAX(tanggal) as terakhir_aktivitas')
            ->with(['user', 'jabatan'])
            ->groupBy('user_id', 'jabatan_id')
            ->orderBy('total_aktivitas', 'desc')
            ->get();

        // Hitung total aktivitas
        $totalAktivitas = Activity::count();
        $aktivitasHariIni = Activity::whereDate('tanggal', today())->count();
        $aktivitasMingguIni = Activity::whereBetween('tanggal', [now()->startOfWeek(), now()->endOfWeek()])->count();

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