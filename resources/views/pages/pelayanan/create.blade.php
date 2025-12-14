@extends('layouts.admin.app')

@section('title', 'Buat Pelayanan')

@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title fw-semibold mb-4">Form Pelayanan Masyarakat</h5>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('pelayanan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Pelapor (Warga)</label>
                <select name="warga_id" class="form-select" required>
                    <option value="">-- Pilih Warga --</option>
                    @foreach($wargas as $warga)
                        <option value="{{ $warga->warga_id }}">{{ $warga->nama }} ({{ $warga->no_ktp }})</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Jenis Layanan</label>
                <select name="kategori_id" class="form-select" required>
                    <option value="">-- Pilih Layanan --</option>
                    @foreach($kategoris as $cat)
                        <option value="{{ $cat->kategori_id }}">{{ $cat->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Judul Layanan</label>
            <input type="text" name="judul" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi Pelayanan</label>
            <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
        </div>

        <div class="row">
            <div class="col-md-8 mb-3">
                <label class="form-label">Lokasi / Alamat</label>
                <input type="text" name="lokasi_text" class="form-control" placeholder="Jalan Mawar...">
            </div>
            <div class="col-md-2 mb-3">
                <label class="form-label">RT</label>
                <input type="text" name="rt" class="form-control">
            </div>
             <div class="col-md-2 mb-3">
                <label class="form-label">RW</label>
                <input type="text" name="rw" class="form-control">
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label">Lampiran / Bukti (Opsional)</label>
            <input type="file" name="lampiran" class="form-control" accept="image/*,application/pdf">
        </div>

        <button type="submit" class="btn btn-primary">Kirim Permohonan</button>
        <a href="{{ route('pelayanan.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
    </form>
  </div>
</div>
@endsection
