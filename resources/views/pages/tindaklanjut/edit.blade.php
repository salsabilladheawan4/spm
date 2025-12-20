@extends('layouts.admin.app')

@section('title', 'Edit Tindak Lanjut')

@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title fw-semibold mb-4">Edit Tindak Lanjut</h5>
    <p class="text-muted">Mengubah riwayat penanganan untuk tiket #{{ $tindak->pengaduan->nomor_tiket }}</p>

    <form action="{{ route('tindak-lanjut.update', $tindak->tindak_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Petugas</label>
            <input type="text" class="form-control" value="{{ $tindak->petugas }}" disabled>
            <small class="text-muted">Nama petugas tidak dapat diubah.</small>
        </div>

        <div class="mb-3">
            <label class="form-label">Aksi yang Dilakukan</label>
            <input type="text" name="aksi" class="form-control" value="{{ old('aksi', $tindak->aksi) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Catatan Tambahan</label>
            <textarea name="catatan" class="form-control" rows="3">{{ old('catatan', $tindak->catatan) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('pengaduan.show', $tindak->pengaduan_id) }}" class="btn btn-outline-secondary ms-2">Batal</a>
    </form>
  </div>
</div>
@endsection
