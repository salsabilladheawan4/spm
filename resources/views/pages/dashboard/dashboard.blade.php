@extends('layouts.admin.app')

@section('title', 'Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm bg-light-primary">
            <div class="card-body px-4 py-4">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('assets-admin/images/logos/suararakyat.png') }}"
                        alt="SIPMA"
                        style="width: 40px; height: 50px;"
                        class="me-3">
                    <div>
                        <h4 class="fw-bold mb-0">SIPMA</h4>
                        <small class="text-muted">
                            Sistem Informasi Pengaduan Masyarakat
                        </small>
                    </div>
                </div>

                <p class="mb-2">
                    <strong>SIPMA</strong> adalah sistem informasi berbasis web yang digunakan untuk
                    memfasilitasi masyarakat dalam menyampaikan pengaduan, keluhan, serta aspirasi
                    terhadap layanan publik secara <strong>online, transparan, dan terstruktur</strong>.
                </p>

                <p class="mb-3">
                    Sistem ini bertujuan untuk meningkatkan kualitas pelayanan publik dengan
                    menyediakan mekanisme pengaduan yang mudah diakses, terdokumentasi,
                    serta dapat dipantau status penyelesaiannya secara real-time.
                </p>

                <div class="row">
                    <div class="col-md-4">
                        <span class="badge bg-primary mb-2">👤 Warga</span>
                        <p class="text-muted mb-0">
                            Mengajukan pengaduan dan memberikan penilaian layanan.
                        </p>
                    </div>
                    <div class="col-md-4">
                        <span class="badge bg-warning text-dark mb-2">🛠 Staff</span>
                        <p class="text-muted mb-0">
                            Menangani dan menindaklanjuti pengaduan masyarakat.
                        </p>
                    </div>
                    <div class="col-md-4">
                        <span class="badge bg-success mb-2">⚙️ Admin</span>
                        <p class="text-muted mb-0">
                            Mengelola sistem, pengguna, dan data pengaduan.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <h3 class="fw-semibold mb-4">Statistik Pengaduan</h3>
    </div>

    {{-- KHUSUS WARGA: QUICK ACTION --}}
    @if(Auth::user()->role === 'warga')
    <div class="col-12 mb-4">
        <div class="card bg-light-primary shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-2">
                            Halo, {{ Auth::user()->name }}! 👋
                        </h4>

                        <p class="mb-2">
                            Terima kasih telah berpartisipasi dalam sistem pengaduan masyarakat.
                        </p>

                        {{-- STATUS PERMOHONAN STAFF --}}
                        @if(Auth::user()->staff_status === 'none')
                        <form action="{{ route('staff.request') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-warning mt-2">
                                <i class="ti ti-user-plus me-1"></i>
                                Ajukan Permohonan Jadi Staff
                            </button>
                        </form>

                        @elseif(Auth::user()->staff_status === 'pending')
                        <span class="badge bg-warning text-dark mt-2">
                            ⏳ Permohonan Staff Sedang Diproses Admin
                        </span>

                        @elseif(Auth::user()->staff_status === 'rejected')
                        <span class="badge bg-danger mt-2">
                            ❌ Permohonan Staff Ditolak
                        </span>
                        @endif

                    </div>

                    <div class="col-3">
                        <div class="text-center mb-n5">
                            <img src="{{ asset('assets-admin/images/backgrounds/rocket.png') }}"
                                alt=""
                                class="img-fluid mb-n4"
                                style="width: 120px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif


    {{-- Kartu Statistik --}}
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-4 text-center">
                        <i class="ti ti-clipboard-text text-primary" style="font-size: 3rem;"></i>
                    </div>
                    <div class="col-8">
                        <h6 class="text-muted font-semibold">Total Pengaduan</h6>
                        <h6 class="fw-semibold mb-0 fs-6">{{ $total_aduan }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-4 text-center">
                        <i class="ti ti-clock text-warning" style="font-size: 3rem;"></i>
                    </div>
                    <div class="col-8">
                        <h6 class="text-muted font-semibold">Sedang Diproses</h6>
                        <h6 class="fw-semibold mb-0 fs-6">{{ $aduan_proses }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-4 text-center">
                        <i class="ti ti-circle-check text-success" style="font-size: 3rem;"></i>
                    </div>
                    <div class="col-8">
                        <h6 class="text-muted font-semibold">Aduan Selesai</h6>
                        <h6 class="fw-semibold mb-0 fs-6">{{ $aduan_selesai }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    {{-- Tabel Pengaduan Masuk Terbaru --}}
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Pengaduan Masuk Terbaru</h5>
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th>No. Tiket</th>
                                <th>Pelapor & Judul</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recents as $item)
                            <tr>
                                <td>#{{ $item->nomor_tiket }}</td>
                                <td>
                                    {{-- PERUBAHAN: Gunakan nama_pelapor bukan relasi warga --}}
                                    <h6 class="fw-semibold mb-1">{{ $item->nama_pelapor }}</h6>
                                    <span class="fw-normal text-muted">{{ Str::limit($item->judul, 25) }}</span>
                                </td>
                                <td>
                                    @php
                                    $colors = [
                                    'pending' => 'secondary',
                                    'verifikasi' => 'info',
                                    'proses' => 'warning',
                                    'selesai' => 'success',
                                    'ditolak' => 'danger'
                                    ];
                                    $color = $colors[$item->status] ?? 'secondary';
                                    @endphp
                                    <span class="badge bg-{{ $color }} rounded-3 fw-semibold">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                                <td>{{ $item->created_at->format('d M Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">Belum ada pengaduan masuk.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel Penilaian Layanan --}}
    <div class="col-lg-12 mt-4">
        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Statistik Penilaian Layanan</h5>
                <div class="table-responsive">
                    <table class="table table-striped text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-5">
                            <tr>
                                <th>No</th>
                                <th>Pengaduan</th>
                                <th>Rating</th>
                                <th>Komentar</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($penilaian_layanan as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <strong>#{{ $item->pengaduan->nomor_tiket }}</strong><br>
                                    <small class="text-muted">{{ Str::limit($item->pengaduan->judul, 40) }}</small>
                                </td>
                                <td><span class="badge bg-warning text-dark">{{ $item->rating }} ⭐</span></td>
                                <td class="text-wrap">{{ $item->komentar ?? '-' }}</td>
                                <td>{{ $item->created_at->format('d M Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">Belum ada penilaian layanan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

{{-- SOLUSI 2: Skrip SweetAlert2 --}}
@push('scripts-bottom')
@if(session('success'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        title: "Berhasil!",
        text: "{!! session('success') !!}",
        icon: "success",
        confirmButtonColor: "#5d87ff",
        timer: 5000
    });
</script>
@endif
@endpush