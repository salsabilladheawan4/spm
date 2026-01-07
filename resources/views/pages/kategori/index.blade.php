@extends('layouts.admin.app')

@section('title', 'Kategori Pengaduan')

@push('css')
<link rel="stylesheet" href="{{ asset('assets-admin/vendors/simple-datatables/style.css') }}">
@endpush

@section('content')
<div class="card w-100">
  <div class="card-body p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h5 class="card-title fw-semibold">Data Kategori Pengaduan</h5>
      <a href="{{ route('kategori.create') }}" class="btn btn-primary">
        <i class="ti ti-plus"></i> Tambah Kategori
      </a>
    </div>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <form method="GET" action="{{ route('kategori.index') }}" class="mb-3">
      <div class="row g-2">
        <div class="col-md-4">
          <input type="text"
            name="keyword"
            value="{{ request('keyword') }}"
            class="form-control"
            placeholder="Cari nama kategori">
        </div>

        <div class="col-md-3">
          <select name="prioritas" class="form-select">
            <option value="">-- Semua Prioritas --</option>
            <option value="tinggi" {{ request('prioritas') == 'tinggi' ? 'selected' : '' }}>Tinggi</option>
            <option value="sedang" {{ request('prioritas') == 'sedang' ? 'selected' : '' }}>Sedang</option>
            <option value="rendah" {{ request('prioritas') == 'rendah' ? 'selected' : '' }}>Rendah</option>
          </select>
        </div>

        <div class="col-md-2">
          <button class="btn btn-primary w-100">
            <i class="ti ti-search"></i> Cari
          </button>
        </div>

        <div class="col-md-2">
          <a href="{{ route('kategori.index') }}" class="btn btn-secondary w-100">
            Reset
          </a>
        </div>
      </div>
    </form>

    <div class="table-responsive">
      <table class="table table-striped text-nowrap mb-0 align-middle" id="table-kategori">
        <thead class="text-dark fs-4">
          <tr>
            <th class="border-bottom-0">
              <h6 class="fw-semibold mb-0">No</h6>
            </th>
            <th class="border-bottom-0">
              <h6 class="fw-semibold mb-0">Nama Kategori</h6>
            </th>
            <th class="border-bottom-0">
              <h6 class="fw-semibold mb-0">SLA (Hari)</h6>
            </th>
            <th class="border-bottom-0">
              <h6 class="fw-semibold mb-0">Prioritas</h6>
            </th>
            <th class="border-bottom-0">
              <h6 class="fw-semibold mb-0">Aksi</h6>
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach ($kategoris as $item)
          <tr>
            <td class="border-bottom-0">
              <h6 class="fw-semibold mb-0">{{ $kategoris->firstItem() + $loop->index }}</h6>
            </td>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->sla_hari }} Hari</td>
            <td>
              @if($item->prioritas == 'tinggi')
              <span class="badge bg-danger">Tinggi</span>
              @elseif($item->prioritas == 'sedang')
              <span class="badge bg-warning">Sedang</span>
              @else
              <span class="badge bg-success">Rendah</span>
              @endif
            </td>
            <td>
              <a href="{{ route('kategori.edit', $item->kategori_id) }}" class="btn btn-warning btn-sm">
                <i class="ti ti-pencil"></i>
              </a>
              <form action="{{ route('kategori.destroy', $item->kategori_id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus kategori ini?')">
                  <i class="ti ti-trash"></i>
                </button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
        <div class="mt-3">
          {{ $kategoris->links() }}
        </div>
      </table>
    </div>
  </div>
</div>
@endsection

@push('scripts-bottom')
<script src="{{ asset('assets-admin/vendors/simple-datatables/simple-datatables.js') }}"></script>
<script>
  new simpleDatatables.DataTable(document.querySelector('#table-kategori'));
</script>
@endpush