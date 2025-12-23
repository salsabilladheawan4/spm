<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use App\Models\PenilaianLayanan;
use Illuminate\Support\Facades\Auth;

class PenilaianLayananController extends Controller
{
    public function index()
    {
        $penilaian = PenilaianLayanan::with('pengaduan')->latest()->paginate(10);
        return view('pages.penilaian.index', compact('penilaian'));
    }

    public function create()
{
    if(Auth::user()->role == 'warga') {
        // Warga hanya bisa menilai laporan mereka sendiri yang sudah SELESAI
        $pengaduan = Pengaduan::where('nama_pelapor', Auth::user()->name)
                              ->where('status', 'selesai')
                              ->get();
    } else {
        $pengaduan = Pengaduan::all();
    }

    return view('pages.penilaian.create', compact('pengaduan'));
}

    public function store(Request $request)
    {
        $request->validate([
            'pengaduan_id' => 'required|exists:pengaduan,pengaduan_id',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable'
        ]);

        PenilaianLayanan::create($request->all());

        return redirect()
            ->route('penilaian.index')
            ->with('success', 'Penilaian berhasil disimpan');
    }

    public function edit($penilaian_id)
    {
        $penilaian = PenilaianLayanan::findOrFail($penilaian_id);
        $pengaduan = Pengaduan::all();

        return view('pages.penilaian.edit', compact('penilaian', 'pengaduan'));
    }

    public function update(Request $request, $penilaian_id)
    {
        $request->validate([
            'pengaduan_id' => 'required|exists:pengaduan,pengaduan_id',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable'
        ]);

        $penilaian = PenilaianLayanan::findOrFail($penilaian_id);
        $penilaian->update($request->all());

        return redirect()
            ->route('penilaian.index')
            ->with('success', 'Penilaian berhasil diperbarui');
    }

    public function destroy($penilaian_id)
    {
        $penilaian = PenilaianLayanan::findOrFail($penilaian_id);
        $penilaian->delete();

        return redirect()
            ->route('penilaian.index')
            ->with('success', 'Penilaian berhasil dihapus');
    }
}
