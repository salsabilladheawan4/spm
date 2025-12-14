<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelayanan;
use App\Models\Warga;
use App\Models\KategoriPelayanan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PelayananController extends Controller
{
    /**
     * Tampilkan daftar pelayanan.
     */
    public function index()
    {
        $items = Pelayanan::with(['warga', 'kategori'])->latest()->get();
        return view('pages.pelayanan.index', compact('items'));
    }

    /**
     * Tampilkan form buat pelayanan baru.
     */
    public function create()
    {
        $wargas = Warga::all();
        $kategoris = KategoriPelayanan::all();
        return view('pages.pelayanan.create', compact('wargas', 'kategoris'));
    }

    /**
     * Simpan data pelayanan baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'warga_id' => 'required|exists:wargas,warga_id',
            'kategori_id' => 'required|exists:kategori_pelayanan,kategori_id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi_text' => 'nullable|string|max:255',
            'rt' => 'nullable|string|max:5',
            'rw' => 'nullable|string|max:5',
            'lampiran' => 'nullable|file|mimes:jpeg,jpg,png,pdf|max:5120',
        ]);

        $pelayanan = new Pelayanan();
        $pelayanan->nomor_tiket = 'TIKET-' . date('Ymd') . '-' . Str::random(4);
        $pelayanan->warga_id = $request->warga_id;
        $pelayanan->kategori_id = $request->kategori_id;
        $pelayanan->judul = $request->judul;
        $pelayanan->deskripsi = $request->deskripsi;
        $pelayanan->lokasi_text = $request->lokasi_text;
        $pelayanan->rt = $request->rt;
        $pelayanan->rw = $request->rw;
        $pelayanan->status = 'pending';

        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/pelayanan', $filename);
            $pelayanan->lampiran = $filename;
        }

        $pelayanan->save();

        return redirect()->route('pages.pelayanan.index')->with('success', 'Pelayanan berhasil dibuat.');
    }

    /**
     * Tampilkan detail pelayanan.
     */
    public function show($id)
    {
        $item = Pelayanan::with(['warga', 'kategori'])->findOrFail($id);
        return view('pelayanan.show', compact('item'));
    }

    /**
     * Tampilkan form edit pelayanan (update status / lampiran).
     */
    public function edit($id)
    {
        $pelayanan = Pelayanan::with(['warga', 'kategori'])->findOrFail($id);
        return view('pages.pelayanan.edit', compact('pelayanan'));
    }

    /**
     * Update data pelayanan.
     */
    public function update(Request $request, $id)
    {
        $pelayanan = Pelayanan::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,verifikasi,proses,selesai,ditolak',
            'lampiran' => 'nullable|file|mimes:jpeg,jpg,png,pdf|max:5120',
        ]);

        $pelayanan->status = $request->status;

        if ($request->hasFile('lampiran')) {
            // Hapus lampiran lama jika ada
            if ($pelayanan->lampiran && Storage::exists('public/pelayanan/' . $pelayanan->lampiran)) {
                Storage::delete('public/pelayanan/' . $pelayanan->lampiran);
            }

            $file = $request->file('lampiran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/pelayanan', $filename);
            $pelayanan->lampiran = $filename;
        }

        $pelayanan->save();

        return redirect()->route('pages.pelayanan.index')->with('success', 'Pelayanan berhasil diperbarui.');
    }

    /**
     * Hapus pelayanan.
     */
    public function destroy($id)
    {
        $pelayanan = Pelayanan::findOrFail($id);

        if ($pelayanan->lampiran && Storage::exists('public/pelayanan/' . $pelayanan->lampiran)) {
            Storage::delete('public/pelayanan/' . $pelayanan->lampiran);
        }

        $pelayanan->delete();

        return redirect()->route('pages.pelayanan.index')->with('success', 'Pelayanan berhasil dihapus.');
    }
}
