<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TindakLanjut extends Model
{
    use HasFactory;

    protected $table = 'tindak_lanjut';
    protected $primaryKey = 'tindak_id';

    protected $fillable = [
        'pengaduan_id',
        'petugas',
        'aksi',
        'catatan',
    ];

    // Relasi ke Pengaduan (Many to One)
    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'pengaduan_id', 'pengaduan_id');
    }

    // Relasi ke Media (Foto Bukti Tindak Lanjut)
    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'tindak_id')
                    ->where('ref_table', 'tindak_lanjut');
    }
}
