<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\KategoriPelayanan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        // Statistik Pengaduan
        $total_aduan = Pengaduan::count();

        // Menghitung yang statusnya masih aktif (Pending/Verifikasi/Proses)
        $aduan_proses = Pengaduan::whereIn('status', ['pending', 'verifikasi', 'proses'])->count();

        // Menghitung yang sudah selesai
        $aduan_selesai = Pengaduan::where('status', 'selesai')->count();

        // 5 Pengaduan Terbaru
        $recents = Pengaduan::with('warga')->latest()->take(5)->get();

        // Kategori Pelayanan dengan jumlah pelayanan terkait
        $kategori_pelayanan = KategoriPelayanan::withCount('pelayanans')->get();

        // Kirim ke view
        return view('pages.dashboard.dashboard', compact(
            'total_aduan',
            'aduan_proses',
            'aduan_selesai',
            'recents',
            'kategori_pelayanan'
        ));
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
