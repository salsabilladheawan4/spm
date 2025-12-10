@extends('layouts.admin.app')

@section('title', 'Tambah Kategori')

@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title fw-semibold mb-4">Tambah Kategori Baru</h5>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('kategori.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nama Kategori</label>
            <input type="text" name="nama" class="form-control" placeholder="Contoh: Infrastruktur Jalan" required>
        </div>
        <div class="mb-3">
            <label class="form-label">SLA (Estimasi Hari Pengerjaan)</label>
            <input type="number" name="sla_hari" class="form-control" placeholder="3" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Prioritas Default</label>
            <select name="prioritas" class="form-select">
                <option value="rendah">Rendah</option>
                <option value="sedang" selected>Sedang</option>
                <option value="tinggi">Tinggi</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('kategori.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
    </form>
  </div>
</div>
@endsection
