@extends('layouts.admin.app')

@section('title', 'Proses Pengaduan')

@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title fw-semibold mb-4">Update Status Pengaduan</h5>

    <form action="{{ route('pengaduan.update', $pengaduan->pengaduan_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nomor Tiket</label>
            <input type="text" class="form-control" value="{{ $pengaduan->nomor_tiket }}" disabled>
        </div>
        <div class="mb-3">
             <label class="form-label">Judul Masalah</label>
             <input type="text" class="form-control" value="{{ $pengaduan->judul }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Update Status</label>
            <select name="status" class="form-select">
                <option value="pending" {{ $pengaduan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="verifikasi" {{ $pengaduan->status == 'verifikasi' ? 'selected' : '' }}>Verifikasi</option>
                <option value="proses" {{ $pengaduan->status == 'proses' ? 'selected' : '' }}>Sedang Diproses</option>
                <option value="selesai" {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="ditolak" {{ $pengaduan->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('pengaduan.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
    </form>
  </div>
</div>
@endsection
