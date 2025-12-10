<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriPengaduan extends Model
{
   use HasFactory;

    // 1. Definisikan nama tabel secara eksplisit
    // Karena nama tabel kita 'kategori_pengaduan' (bukan jamak bahasa inggris standar)
    protected $table = 'kategori_pengaduan';

    // 2. Definisikan Primary Key
    // Karena kita tidak menggunakan 'id', tapi 'kategori_id'
    protected $primaryKey = 'kategori_id';

    // 3. Kolom yang boleh diisi (Mass Assignment)
    protected $fillable = [
        'nama',
        'sla_hari',
        'prioritas'
    ];

    /**
     * Relasi ke model Pengaduan
     * Satu Kategori bisa memiliki banyak Pengaduan (One to Many)
     */
    public function pengaduan()
    {
        // Parameter: RelatedModel, Foreign Key di tabel sana, Local Key di tabel ini
        return $this->hasMany(Pengaduan::class, 'kategori_id', 'kategori_id');
    }
}
