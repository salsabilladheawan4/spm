<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelayanan extends Model
{
    use HasFactory;

    // Nama table
    protected $table = 'pelayanan';

    // Primary key
    protected $primaryKey = 'id';

    // Mass assignable fields
    protected $fillable = [
        'nomor_tiket',
        'warga_id',
        'kategori_id',
        'judul',
        'deskripsi',
        'status',
        'prioritas',
        'lokasi_text',
        'rt',
        'rw',
        'lampiran',
        'petugas_id',
        'tanggal_selesai'
    ];

    /**
     * Relasi ke Warga (Pelapor)
     */
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }

    /**
     * Relasi ke Kategori Pelayanan
     */
    public function kategori()
    {
        return $this->belongsTo(KategoriPelayanan::class, 'kategori_id', 'kategori_id');
    }

    /**
     * Relasi ke Petugas yang menangani
     */
    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id', 'id');
    }

    /**
     * Accessor untuk URL lampiran jika disimpan di storage
     */
    public function getLampiranUrlAttribute()
    {
        if ($this->lampiran) {
            return asset('storage/pelayanan/' . $this->lampiran);
        }
        return null;
    }
}
