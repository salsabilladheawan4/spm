<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\PenilaianLayanan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        // ======================
        // STATISTIK PENGADUAN
        // ======================
        $total_aduan = Pengaduan::count();

        $aduan_proses = Pengaduan::whereIn('status', [
            'pending',
            'verifikasi',
            'proses'
        ])->count();

        $aduan_selesai = Pengaduan::where('status', 'selesai')->count();

        // ======================
        // PENGADUAN TERBARU
        // ======================
        $recents = Pengaduan::with('warga')
            ->latest()
            ->take(5)
            ->get();

        // ======================
        // PENILAIAN LAYANAN TERBARU
        // ======================
        $penilaian_layanan = PenilaianLayanan::with('pengaduan')
            ->latest()
            ->take(5)
            ->get();

        // ======================
        // KIRIM KE VIEW
        // ======================
        return view('pages.dashboard.dashboard', compact(
            'total_aduan',
            'aduan_proses',
            'aduan_selesai',
            'recents',
            'penilaian_layanan'
        ));
    }
}
