<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    // TAMPILKAN SEMUA KARYAWAN
    public function index()
    {
        $karyawans = Karyawan::all();
        return view('karyawan', compact('karyawans'));
    }

    // SIMPAN KARYAWAN BARU
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'      => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
        ]);

        Karyawan::create($validated);

        return redirect()
            ->route('karyawan.index')
            ->with('success', 'Karyawan berhasil ditambahkan');
    }

    // UPDATE KARYAWAN (untuk fitur edit nanti)
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama'      => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
        ]);

        $karyawan = Karyawan::findOrFail($id);
        $karyawan->update($validated);

        return redirect()
            ->route('karyawan.index')
            ->with('success', 'Data karyawan berhasil diubah');
    }

    // HAPUS KARYAWAN
    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();

        return redirect()
            ->route('karyawan.index')
            ->with('success', 'Karyawan berhasil dihapus');
    }
}
