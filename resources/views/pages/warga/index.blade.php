@extends('layouts.admin.app')

@section('title', 'Data Warga')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/simple-datatables/style.css') }}">
@endpush

@section('content')
<div class="card w-100">
  <div class="card-body p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="card-title fw-semibold">Data Warga</h5>
        <a href="{{ route('warga.create') }}" class="btn btn-primary">
            <i class="ti ti-plus"></i> Tambah Warga Baru
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive">
      <table class="table table-striped text-nowrap mb-0 align-middle" id="table1">
        <thead class="text-dark fs-4">
          <tr>
            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">#</h6></th>
            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">No. KTP</h6></th>
            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Nama Warga</h6></th>
            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Jenis Kelamin</h6></th>
            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Pekerjaan</h6></th>
            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Aksi</h6></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($wargas as $warga)
          <tr>
            <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6></td>
            <td class="border-bottom-0">
              <p class="mb-0 fw-normal">{{ $warga->no_ktp }}</p>
            </td>
            <td class="border-bottom-0">
              <p class="mb-0 fw-normal">{{ $warga->nama }}</p>
            </td>
            <td class="border-bottom-0">
              <p class="mb-0 fw-normal">{{ $warga->jenis_kelamin }}</p>
            </td>
            <td class="border-bottom-0">
              <p class="mb-0 fw-normal">{{ $warga->pekerjaan }}</p>
            </td>
            <td class="border-bottom-0">
              <a href="{{ route('warga.edit', $warga->warga_id) }}" class="btn btn-warning btn-sm">
                <i class="ti ti-pencil"></i> Edit
              </a>
              <form action="{{ route('warga.destroy', $warga->warga_id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin?')">
                  <i class="ti ti-trash"></i> Hapus
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
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>
@endpush
