@extends('layouts.admin.app')

@section('title', 'Edit Kategori Pelayanan')

@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title fw-semibold mb-4">Edit Kategori Pelayanan</h5>

    <form action="{{ route('kategoripelayanan.update', $kategoripelayanan->kategori_pelayanan_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Kategori Pelayanan</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama', $kategori_pelayanan->nama) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">SLA (Hari)</label>
            <input type="number" name="sla_hari" class="form-control" value="{{ old('sla_hari', $kategori_pelayanan->sla_hari) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Prioritas</label>
            <select name="prioritas" class="form-select">
                <option value="rendah" {{ $kategori_pelayanan->prioritas == 'rendah' ? 'selected' : '' }}>Rendah</option>
                <option value="sedang" {{ $kategori_pelayanan->prioritas == 'sedang' ? 'selected' : '' }}>Sedang</option>
                <option value="tinggi" {{ $kategori_pelayanan->prioritas == 'tinggi' ? 'selected' : '' }}>Tinggi</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('kategoripelayanan.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
    </form>
  </div>
</div>
@endsection
