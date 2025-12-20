@extends('layouts.admin.app')

@section('title', 'Tambah Tindak Lanjut')

@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title fw-semibold mb-4">Form Tambah Tindak Lanjut</h5>
    <p class="text-muted mb-4">Gunakan form ini untuk mencatat tindakan yang dilakukan pada laporan warga.</p>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
        </div>
    @endif

    <form action="{{ route('tindak-lanjut.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Pilih Tiket Pengaduan</label>
                <select name="pengaduan_id" class="form-select" required>
                    <option value="">-- Pilih Nomor Tiket --</option>
                    @foreach($pengaduans as $p)
                        <option value="{{ $p->pengaduan_id }}">
                            #{{ $p->nomor_tiket }} - {{ Str::limit($p->judul, 30) }} ({{ $p->warga->nama }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Update Status Pengaduan Menjadi</label>
                <select name="status_baru" class="form-select" required>
                    <option value="verifikasi">Verifikasi</option>
                    <option value="proses" selected>Sedang Diproses</option>
                    <option value="selesai">Selesai</option>
                    <option value="ditolak">Ditolak</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Aksi / Tindakan</label>
            <input type="text" name="aksi" class="form-control" placeholder="Misal: Perbaikan lampu jalan" value="{{ old('aksi') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Catatan Detail</label>
            <textarea name="catatan" class="form-control" rows="4" placeholder="Jelaskan detail tindakan yang dilakukan...">{{ old('catatan') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="form-label">Foto Bukti Tindakan (Opsional)</label>
            <input type="file" name="foto_bukti" class="form-control" accept="image/*">
            <small class="text-muted">Format: JPG, PNG. Max: 2MB</small>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Tindak Lanjut</button>
        <a href="{{ route('pengaduan.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
    </form>
  </div>
</div>
@endsection
