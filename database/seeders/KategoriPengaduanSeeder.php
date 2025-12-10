<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KategoriPengaduan;

class KategoriPengaduanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = [
            [
                'nama'      => 'Infrastruktur & Jalan',
                'sla_hari'  => 7, // Estimasi perbaikan 1 minggu
                'prioritas' => 'tinggi',
            ],
            [
                'nama'      => 'Kebersihan & Lingkungan',
                'sla_hari'  => 3, // Sampah/selokan mampet harus cepat
                'prioritas' => 'sedang',
            ],
            [
                'nama'      => 'Administrasi Kependudukan',
                'sla_hari'  => 5, // Pengurusan surat/KTP
                'prioritas' => 'sedang',
            ],
            [
                'nama'      => 'Keamanan & Ketertiban',
                'sla_hari'  => 1, // Maling/keributan butuh respons cepat (24 jam)
                'prioritas' => 'tinggi',
            ],
            [
                'nama'      => 'Bantuan Sosial (Bansos)',
                'sla_hari'  => 14, // Verifikasi data biasanya butuh waktu
                'prioritas' => 'sedang',
            ],
            [
                'nama'      => 'Fasilitas Kesehatan',
                'sla_hari'  => 2,
                'prioritas' => 'tinggi',
            ],
            [
                'nama'      => 'Lampu Penerangan Jalan',
                'sla_hari'  => 4,
                'prioritas' => 'rendah',
            ],
        ];

        foreach ($kategoris as $kategori) {
            KategoriPengaduan::create($kategori);
        }
    }
}
