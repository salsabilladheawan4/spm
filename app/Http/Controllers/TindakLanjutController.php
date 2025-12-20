<?php

namespace App\Http\Controllers;

use App\Models\TindakLanjut;
use App\Models\Pengaduan;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TindakLanjutController extends Controller
{
    // Menampilkan Form Create Terpisah
    public function create()
    {
        // Ambil pengaduan yang statusnya belum selesai/ditolak agar bisa ditindaklanjuti
        $pengaduans = Pengaduan::whereNotIn('status', ['selesai', 'ditolak'])->get();
        return view('pages.tindaklanjut.create', compact('pengaduans'));
    }

    // Menyimpan Data
    public function store(Request $request)
    {
        $request->validate([
            'pengaduan_id' => 'required|exists:pengaduan,pengaduan_id',
            'aksi'         => 'required|string|max:255',
            'catatan'      => 'nullable|string',
            'foto_bukti'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status_baru'  => 'required|in:verifikasi,proses,selesai,ditolak'
        ]);

        // 1. Simpan ke tabel tindak_lanjut
        $tl = TindakLanjut::create([
            'pengaduan_id' => $request->pengaduan_id,
            'petugas'      => Auth::user()->name ?? 'Admin',
            'aksi'         => $request->aksi,
            'catatan'      => $request->catatan,
        ]);

        // 2. Update status di tabel pengaduan
        $pengaduan = Pengaduan::findOrFail($request->pengaduan_id);
        $pengaduan->update(['status' => $request->status_baru]);

        // 3. Simpan foto ke tabel media (jika ada)
        if ($request->hasFile('foto_bukti')) {
            $file = $request->file('foto_bukti');
            $path = $file->store('uploads/tindak_lanjut', 'public');

            Media::create([
                'ref_table' => 'tindak_lanjut',
                'ref_id'    => $tl->tindak_id,
                'file_url'  => $path,
                'caption'   => 'Foto Tindak Lanjut',
                'mime_type' => $file->getClientMimeType(),
            ]);
        }

        return redirect()->route('pengaduan.show', $request->pengaduan_id)
                         ->with('success', 'Tindak lanjut berhasil disimpan!');
    }
    public function edit($id)
    {
        $tindak = TindakLanjut::findOrFail($id);
        return view('pages.tindaklanjut.edit', compact('tindak'));
    }

    // 3. UPDATE: Menyimpan perubahan
    public function update(Request $request, $id)
    {
        $request->validate([
            'aksi'    => 'required|string',
            'catatan' => 'nullable|string',
        ]);

        $tindak = TindakLanjut::findOrFail($id);
        $tindak->update([
            'aksi'    => $request->aksi,
            'catatan' => $request->catatan,
        ]);

        // Redirect kembali ke halaman detail pengaduan asalnya
        return redirect()->route('pengaduan.show', $tindak->pengaduan_id)
                         ->with('success', 'Tindak lanjut berhasil diperbarui!');
    }

    // 4. DESTROY (DELETE): Menghapus data
    public function destroy($id)
    {
        $tindak = TindakLanjut::findOrFail($id);
        $tindak->delete();

        return back()->with('success', 'Riwayat tindak lanjut dihapus.');
    }

    // ... method edit, update, destroy tetap seperti sebelumnya
}
