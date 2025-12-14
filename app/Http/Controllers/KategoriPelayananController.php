<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriPelayanan;

class KategoriPelayananController extends Controller
{
    /**
     * Tampilkan daftar kategori pelayanan
     */
    public function index()
    {
        $items = KategoriPelayanan::latest()->get(); // Sesuai dengan view index
        return view('pages.kategoripelayanan.index', compact('items'));
    }

    /**
     * Tampilkan form buat kategori baru
     */
    public function create()
    {
        return view('pages.kategoripelayanan.create');
    }

    /**
     * Simpan kategori baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'sla_hari'  => 'required|integer|min:1',
            'prioritas' => 'required|in:rendah,sedang,tinggi',
        ]);

        KategoriPelayanan::create($request->only(['nama', 'sla_hari', 'prioritas']));

        return redirect()->route('kategoripelayanan.index')
                         ->with('success', 'Kategori Pelayanan berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit kategori
     */
    public function edit(KategoriPelayanan $kategoripelayanan)
    {
        return view('pages.kategoripelayanan.edit', compact('kategoripelayanan'));
    }

    /**
     * Update kategori
     */
    public function update(Request $request, KategoriPelayanan $kategoripelayanan)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'sla_hari'  => 'required|integer|min:1',
            'prioritas' => 'required|in:rendah,sedang,tinggi',
        ]);

        $kategoripelayanan->update($request->only(['nama', 'sla_hari', 'prioritas']));

        return redirect()->route('kategoripelayanan.index')
                         ->with('success', 'Kategori Pelayanan berhasil diperbarui.');
    }

    /**
     * Hapus kategori
     */
    public function destroy(KategoriPelayanan $kategoripelayanan)
    {
        // Opsional: cek relasi dengan tabel pelayanan
        if ($kategoripelayanan->pelayanans()->count() > 0) {
            return redirect()->route('kategoripelayanan.index')
                             ->with('error', 'Kategori masih memiliki pelayanan terkait.');
        }

        $kategoripelayanan->delete();

        return redirect()->route('kategoripelayanan.index')
                         ->with('success', 'Kategori Pelayanan berhasil dihapus.');
    }
}
