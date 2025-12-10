@extends('layouts.admin.app')

@section('title', 'Edit Kategori')

@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title fw-semibold mb-4">Edit Kategori</h5>

    <form action="{{ route('kategori.update', $kategori->kategori_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Kategori</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama', $kategori->nama) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">SLA (Hari)</label>
            <input type="number" name="sla_hari" class="form-control" value="{{ old('sla_hari', $kategori->sla_hari) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Prioritas</label>
            <select name="prioritas" class="form-select">
                <option value="rendah" {{ $kategori->prioritas == 'rendah' ? 'selected' : '' }}>Rendah</option>
                <option value="sedang" {{ $kategori->prioritas == 'sedang' ? 'selected' : '' }}>Sedang</option>
                <option value="tinggi" {{ $kategori->prioritas == 'tinggi' ? 'selected' : '' }}>Tinggi</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('kategori.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
    </form>
  </div>
</div>
@endsection
