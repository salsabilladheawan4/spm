<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPelayanan extends Model
{
    use HasFactory;

    // Nama table
    protected $table = 'kategori_pelayanan';

    // Primary key
    protected $primaryKey = 'kategori_id';

    // Mass assignable fields
    protected $fillable = [
        'nama',
        'sla_hari',
        'prioritas'
    ];


    /**
     * Relasi ke Pelayanan
     * Satu kategori bisa dimiliki banyak pelayanan
     */
    public function pelayanans()
    {
        return $this->hasMany(Pelayanan::class, 'kategori_id', 'kategori_id');
    }
}
