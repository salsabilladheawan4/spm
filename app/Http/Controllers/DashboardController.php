<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\PenilaianLayanan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Statistik Pengaduan
        $total_aduan = Pengaduan::count();

        $aduan_proses = Pengaduan::whereIn('status', [
            'pending',
            'verifikasi',
            'proses'
        ])->count();

        $aduan_selesai = Pengaduan::where('status', 'selesai')->count();

        $recents = Pengaduan::latest()
            ->take(5)
            ->get();

        // 3. Penilaian Layanan Terbaru
        $penilaian_layanan = PenilaianLayanan::with('pengaduan')
            ->latest()
            ->take(5)
            ->get();

        return view('pages.dashboard.dashboard', compact(
            'total_aduan',
            'aduan_proses',
            'aduan_selesai',
            'recents',
            'penilaian_layanan'
        ));
    }
}
