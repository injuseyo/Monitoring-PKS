<?php

namespace App\Http\Controllers;

use App\Models\Aktivitas;
use App\Models\Karyawan;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;

class AktivitasController extends Controller
{
    // LIST + FILTER
    public function index(Request $request)
    {
        $karyawans  = Karyawan::orderBy('nama')->get();
        $pekerjaans = Pekerjaan::orderBy('nama')->get();

        $query = Aktivitas::with(['karyawan', 'pekerjaan']);

        if ($request->filled('karyawan_id')) {
            $query->where('karyawan_id', $request->karyawan_id);
        }

        if ($request->filled('pekerjaan_id')) {
            $query->where('pekerjaan_id', $request->pekerjaan_id);
        }

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        $aktivitas = $query
            ->orderBy('tanggal', 'desc')
            ->orderBy('waktu', 'asc')
            ->get();

        return view('aktivitas', compact('karyawans', 'pekerjaans', 'aktivitas'));
    }

    // SIMPAN AKTIVITAS BARU
    public function store(Request $request)
    {
        $validated = $request->validate([
            'karyawan_id'  => 'required|exists:karyawans,id',
            'pekerjaan_id' => 'required|exists:pekerjaans,id',
            'deskripsi'    => 'required|string|max:255',
            'tanggal'      => 'required|date',
            'waktu'        => 'required|string|max:10',
            'foto'         => 'nullable|image|max:2048', // max 2MB
        ]);

        // handle upload foto (opsional)
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('aktivitas', 'public');
            $validated['foto'] = 'storage/' . $path;
        }

        Aktivitas::create($validated);

        return redirect()
            ->route('aktivitas.index')
            ->with('success', 'Aktivitas berhasil ditambahkan');
    }
}
