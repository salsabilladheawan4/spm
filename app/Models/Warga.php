<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder; // Import Builder
use Illuminate\Http\Request;

class Warga extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit
    protected $table = 'wargas';

    // Menentukan primary key
    protected $primaryKey = 'warga_id';

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'no_ktp',
        'nama',
        'jenis_kelamin',
        'agama',
        'pekerjaan',
        'telp',
        'email'
    ];

    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }
        return $query;
    }
}
