@extends('layouts.admin.app')

@section('title', 'Daftar Penilaian Layanan')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/simple-datatables/style.css') }}">
@endpush

@section('content')
<div class="card w-100">
  <div class="card-body p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="card-title fw-semibold">Penilaian Layanan</h5>
        <a href="{{ route('penilaian.create') }}" class="btn btn-primary">
            <i class="ti ti-plus"></i> Tambah Penilaian
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive">
      <table class="table table-striped text-nowrap mb-0 align-middle" id="table-penilaian">
        <thead class="text-dark fs-4">
          <tr>
            <th>No</th>
            <th>Pengaduan</th>
            <th>Rating</th>
            <th>Komentar</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($penilaian as $item)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                #{{ $item->pengaduan->pengaduan_id ?? '-' }} <br>
                <small class="text-muted">
                    {{ $item->pengaduan->judul ?? '-' }}
                </small>
            </td>
            <td>
                <span class="badge bg-warning text-dark">
                    {{ $item->rating }} ⭐
                </span>
            </td>
            <td>{{ Str::limit($item->komentar, 40) }}</td>
            <td>
              <a href="{{ route('penilaian.edit', $item->penilaian_id) }}"
                 class="btn btn-warning btn-sm" title="Edit">
                <i class="ti ti-pencil"></i>
              </a>

              <form action="{{ route('penilaian.destroy', $item->penilaian_id) }}"
                    method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Hapus penilaian ini?')">
                    <i class="ti ti-trash"></i>
                </button>
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
    <script>
        new simpleDatatables.DataTable(
            document.querySelector('#table-penilaian')
        );
    </script>
@endpush
