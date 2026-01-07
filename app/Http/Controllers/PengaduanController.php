<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\User;
use App\Models\Pengaduan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KategoriPengaduan;
use Illuminate\Support\Facades\Storage;
use App\Notifications\PengaduanBaruNotification;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Eager loading relasi kategori
        $items = Pengaduan::with(['kategori'])->latest()->paginate(10);
        return view('pages.pengaduan.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = KategoriPengaduan::all();
        return view('pages.pengaduan.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelapor' => 'required|string|max:100',
            'kategori_id'  => 'required|exists:kategori_pengaduan,kategori_id',
            'judul'        => 'required|string|max:200',
            'deskripsi'    => 'required',
            'bukti_foto'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $nomor_tiket = 'TKT-' . strtoupper(Str::random(8));

        $pengaduan = Pengaduan::create([
            'nomor_tiket'  => $nomor_tiket,
            'nama_pelapor' => $request->nama_pelapor,
            'kategori_id'  => $request->kategori_id,
            'judul'        => $request->judul,
            'deskripsi'    => $request->deskripsi,
            'status'       => 'pending',
            'lokasi_text'  => $request->lokasi_text,
            'rt'           => $request->rt,
            'rw'           => $request->rw,
        ]);

        // 🔔 Notifikasi ke admin
        User::where('role', 'admin')->each(function ($admin) use ($pengaduan) {
            $admin->notify(new PengaduanBaruNotification($pengaduan));
        });

        // 📷 Upload foto (OPSIONAL)
        if ($request->hasFile('bukti_foto')) {
            $file = $request->file('bukti_foto');
            $path = $file->store('uploads/pengaduan', 'public');

            Media::create([
                'ref_table'  => 'pengaduan',
                'ref_id'     => $pengaduan->pengaduan_id,
                'file_url'   => $path,
                'caption'    => 'Bukti Pengaduan',
                'mime_type'  => $file->getClientMimeType(),
                'sort_order' => 1
            ]);
        }

        return redirect()->route('dashboard')
            ->with('success', 'Laporan #' . $nomor_tiket . ' berhasil dikirim');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pengaduan = Pengaduan::with([
            'kategori',
            'media',
            'tindakLanjut.media'
        ])->findOrFail($id);

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
        $pengaduan->update(['status' => $request->status]);

        User::where('role', 'admin')->each(function ($admin) use ($pengaduan) {
            $admin->notify(new PengaduanBaruNotification($pengaduan));
        });




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
