@extends('layouts.admin.app')

@section('title', 'Daftar Pengaduan')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/simple-datatables/style.css') }}">
@endpush

@section('content')
<div class="card w-100">
  <div class="card-body p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="card-title fw-semibold">Pengaduan Masuk</h5>
        <a href="{{ route('pengaduan.create') }}" class="btn btn-primary">
            <i class="ti ti-plus"></i> Buat Pengaduan
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive">
      <table class="table table-striped text-nowrap mb-0 align-middle" id="table-pengaduan">
        <thead class="text-dark fs-4">
          <tr>
            <th>No Tiket</th>
            <th>Pelapor</th>
            <th>Kategori</th>
            <th>Judul</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($items as $item)
          <tr>
            <td class="fw-semibold">#{{ $item->nomor_tiket }}</td>
            <td>{{ $item->warga->nama }}</td>
            <td>{{ $item->kategori->nama }}</td>
            <td>{{ Str::limit($item->judul, 30) }}</td>
            <td>
                @php
                    $badges = [
                        'pending' => 'bg-secondary',
                        'verifikasi' => 'bg-info',
                        'proses' => 'bg-warning',
                        'selesai' => 'bg-success',
                        'ditolak' => 'bg-danger'
                    ];
                @endphp
                <span class="badge {{ $badges[$item->status] ?? 'bg-secondary' }}">
                    {{ ucfirst($item->status) }}
                </span>
            </td>
            <td>
              <a href="{{ route('pengaduan.show', $item->pengaduan_id) }}" class="btn btn-info btn-sm" title="Lihat Detail">
                <i class="ti ti-eye"></i>
              </a>
              <a href="{{ route('pengaduan.edit', $item->pengaduan_id) }}" class="btn btn-warning btn-sm" title="Edit Status">
                <i class="ti ti-pencil"></i>
              </a>
              <form action="{{ route('pengaduan.destroy', $item->pengaduan_id) }}" method="POST" class="d-inline">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')"><i class="ti ti-trash"></i></button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

@push('scripts-bottom')
    <script src="{{ asset('assets-admin/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script>new simpleDatatables.DataTable(document.querySelector('#table-pengaduan'));</script>
@endpush
