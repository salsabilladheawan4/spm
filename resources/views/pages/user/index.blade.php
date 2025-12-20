@extends('layouts.admin.app')

@section('title', 'Data User')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/simple-datatables/style.css') }}">
@endpush

@section('content')
<div class="card w-100">
  <div class="card-body p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="card-title fw-semibold">Data User</h5>
        <a href="{{ route('user.create') }}" class="btn btn-primary">
            <i class="ti ti-plus"></i> Tambah User Baru
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {!! session('success') !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive">
      <table class="table table-striped text-nowrap mb-0 align-middle" id="table1">
        <thead class="text-dark fs-4">
          <tr>
            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">#</h6></th>
            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Nama Lengkap</h6></th>
            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Email</h6></th>
            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Aksi</h6></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($dataUser as $item)
          <tr>
            <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6></td>
            <td class="border-bottom-0">
              <p class="mb-0 fw-normal">{{ $item->name }}</p>
            </td>
            <td class="border-bottom-0">
              <p class="mb-0 fw-normal">{{ $item->email }}</p>
            </td>
            <td class="border-bottom-0">
              <a href="{{ route('user.edit', $item->id) }}" class="btn btn-warning btn-sm">
                <i class="ti ti-pencil"></i> Edit
              </a>
              <form action="{{ route('user.destroy', $item->id) }}" method="POST" class="d-inline">
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