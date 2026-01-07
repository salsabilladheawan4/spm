<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $table      = 'pengaduan';
    protected $primaryKey = 'pengaduan_id';
    protected $fillable = [
        'nomor_tiket',
        'nama_pelapor', // Tambahkan ini
        'kategori_id',
        'judul',
        'deskripsi',
        'status',
        'lokasi_text',
        'rt',
        'rw',
    ];
    // Relasi ke Kategori
    public function kategori()
    {
        return $this->belongsTo(KategoriPengaduan::class, 'kategori_id', 'kategori_id');
    }

    // Relasi ke Media (Mengambil foto bukti)
    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'pengaduan_id')
            ->where('ref_table', 'pengaduan');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tindakLanjut()
    {
        return $this->hasMany(TindakLanjut::class, 'pengaduan_id')
            ->latest();
    }
}
