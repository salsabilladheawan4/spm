@extends('layouts.admin.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h3 class="fw-semibold mb-4">Statistik Pengaduan</h3>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-4">
                        <div class="text-center">
                            <i class="ti ti-clipboard-text text-primary" style="font-size: 3rem;"></i>
                        </div>
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
                    <div class="col-4">
                        <div class="text-center">
                            <i class="ti ti-clock text-warning" style="font-size: 3rem;"></i>
                        </div>
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
                    <div class="col-4">
                        <div class="text-center">
                            <i class="ti ti-circle-check text-success" style="font-size: 3rem;"></i>
                        </div>
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
  <div class="col-lg-12 d-flex align-items-stretch">
    <div class="card w-100">
      <div class="card-body p-4">
        <h5 class="card-title fw-semibold mb-4">Pengaduan Masuk Terbaru</h5>
        <div class="table-responsive">

          <table class="table text-nowrap mb-0 align-middle">
            <thead class="text-dark fs-4">
              <tr>
                <th class="border-bottom-0"><h6 class="fw-semibold mb-0">No. Tiket</h6></th>
                <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Pelapor & Judul</h6></th>
                <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Status</h6></th>
                <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Tanggal</h6></th>
              </tr>
            </thead>
            <tbody>
              @forelse ($recents as $item)
              <tr>
                <td class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">#{{ $item->nomor_tiket }}</h6>
                </td>
                <td class="border-bottom-0">
                    <h6 class="fw-semibold mb-1">{{ $item->warga->nama }}</h6>
                    <span class="fw-normal text-muted">{{ Str::limit($item->judul, 25) }}</span>
                </td>
                <td class="border-bottom-0">
                    @php
                        $color = 'secondary';
                        if($item->status == 'pending') $color = 'secondary';
                        if($item->status == 'verifikasi') $color = 'info';
                        if($item->status == 'proses') $color = 'warning';
                        if($item->status == 'selesai') $color = 'success';
                        if($item->status == 'ditolak') $color = 'danger';
                    @endphp
                    <span class="badge bg-{{ $color }} rounded-3 fw-semibold">
                        {{ ucfirst($item->status) }}
                    </span>
                </td>
                <td class="border-bottom-0">
                  <p class="mb-0 fw-normal">{{ $item->created_at->format('d M Y') }}</p>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="4" class="text-center border-bottom-0 py-4">
                    <img src="{{ asset('assets-admin/images/products/s1.jpg') }}" alt="Kosong" width="50" class="mb-2 grayscale" style="filter: grayscale(1);">
                    <p class="mb-0 fw-normal text-muted">Belum ada pengaduan masuk.</p>
                </td>
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
