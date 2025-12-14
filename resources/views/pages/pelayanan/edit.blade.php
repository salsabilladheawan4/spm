@extends('layouts.admin.app')

@section('title', 'Proses Pelayanan')

@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title fw-semibold mb-4">Update Status Pelayanan</h5>

    <form action="{{ route('pelayanan.update', $pelayanan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nomor Tiket</label>
            <input type="text" class="form-control" value="{{ $pelayanan->nomor_tiket }}" disabled>
        </div>
        <div class="mb-3">
             <label class="form-label">Judul Layanan</label>
             <input type="text" class="form-control" value="{{ $pelayanan->judul }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Update Status</label>
            <select name="status" class="form-select">
                <option value="pending" {{ $pelayanan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="verifikasi" {{ $pelayanan->status == 'verifikasi' ? 'selected' : '' }}>Verifikasi</option>
                <option value="proses" {{ $pelayanan->status == 'proses' ? 'selected' : '' }}>Sedang Diproses</option>
                <option value="selesai" {{ $pelayanan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="ditolak" {{ $pelayanan->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Lampiran Baru (Opsional)</label>
            <input type="file" name="lampiran" class="form-control" accept="image/*,application/pdf">
            @if($pelayanan->lampiran)
                <small class="text-muted">Lampiran saat ini: {{ $pelayanan->lampiran }}</small>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('pelayanan.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
    </form>
  </div>
</div>
@endsection
