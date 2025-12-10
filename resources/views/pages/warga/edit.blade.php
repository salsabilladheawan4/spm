@extends('layouts.admin.app')

@section('title', 'Edit Warga')

@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title fw-semibold mb-4">Formulir Edit Warga</h5>
    <p class="text-muted mb-4">Ubah data warga: <strong>{{ $warga->nama }}</strong></p>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('warga.update', $warga->warga_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">No. KTP</label>
            <input type="text" name="no_ktp" class="form-control" value="{{ old('no_ktp', $warga->no_ktp) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama', $warga->nama) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-select" required>
                <option value="Laki-laki" {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Agama</label>
            <input type="text" name="agama" class="form-control" value="{{ old('agama', $warga->agama) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Pekerjaan</label>
            <input type="text" name="pekerjaan" class="form-control" value="{{ old('pekerjaan', $warga->pekerjaan) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">No. Telepon (Opsional)</label>
            <input type="text" name="telp" class="form-control" value="{{ old('telp', $warga->telp) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Email (Opsional)</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $warga->email) }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Perubahan</button>
        <a href="{{ route('warga.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
    </form>
  </div>
</div>
@endsection
