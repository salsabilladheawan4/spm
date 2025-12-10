<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Warga;
use App\Models\Pengaduan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\KategoriPengaduan;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Eager loading relasi warga dan kategori
        $items = Pengaduan::with(['warga', 'kategori'])->latest()->paginate(10);
        return view('pages.pengaduan.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $wargas = Warga::all(); // Untuk dropdown pilih warga
        $kategoris = KategoriPengaduan::all();
        return view('pages.pengaduan.create', compact('wargas', 'kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
            'warga_id'    => 'required|exists:wargas,warga_id',
            'kategori_id' => 'required|exists:kategori_pengaduan,kategori_id',
            'judul'       => 'required|string|max:200',
            'deskripsi'   => 'required',
            'bukti_foto'  => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi foto
        ]);

        // 1. Generate Nomor Tiket Otomatis (Contoh: TIKET-UNIQID)
        $nomor_tiket = 'TKT-' . strtoupper(Str::random(8));

        // 2. Simpan Data Pengaduan
        $pengaduan = Pengaduan::create([
            'nomor_tiket' => $nomor_tiket,
            'warga_id'    => $request->warga_id,
            'kategori_id' => $request->kategori_id,
            'judul'       => $request->judul,
            'deskripsi'   => $request->deskripsi,
            'status'      => 'pending',
            'lokasi_text' => $request->lokasi_text,
            'rt'          => $request->rt,
            'rw'          => $request->rw,
        ]);

        // 3. Proses Upload ke Tabel Media
        if ($request->hasFile('bukti_foto')) {
            $file = $request->file('bukti_foto');
            // Simpan fisik file ke folder storage/app/public/uploads
            $path = $file->store('uploads', 'public');

            // Simpan record ke tabel media
            Media::create([
                'ref_table' => 'pengaduan',
                'ref_id'    => $pengaduan->pengaduan_id,
                'file_url'  => $path,
                'caption'   => 'Bukti Pengaduan',
                'mime_type' => $file->getClientMimeType(),
                'sort_order'=> 1
            ]);
        }

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pengaduan = Pengaduan::with(['warga', 'kategori', 'media'])->findOrFail($id);
        return view('pages.pengaduan.show', compact('pengaduan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        return view('pages.pengaduan.edit', compact('pengaduan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|in:pending,verifikasi,proses,selesai,ditolak'
        ]);

        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->update([
            'status' => $request->status
        ]);

        return redirect()->route('pengaduan.index')->with('success', 'Status pengaduan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pengaduan = Pengaduan::with('media')->findOrFail($id);

        // Hapus file fisik gambar jika ada
        foreach ($pengaduan->media as $media) {
            if (Storage::disk('public')->exists($media->file_url)) {
                Storage::disk('public')->delete($media->file_url);
            }
            $media->delete(); // Hapus record di tabel media
        }

        // Hapus data pengaduan
        $pengaduan->delete();

        return redirect()->route('pengaduan.index')->with('success', 'Data pengaduan berhasil dihapus.');
    }
}
