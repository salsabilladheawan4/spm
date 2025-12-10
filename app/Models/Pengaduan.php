<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $table      = 'pengaduan';
    protected $primaryKey = 'pengaduan_id';
    protected $guarded    = [];

    // Relasi ke Warga
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }

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
}
