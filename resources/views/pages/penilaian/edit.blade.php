@extends('layouts.admin.app')

@section('title', 'Edit Penilaian Layanan')

@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title fw-semibold mb-4">Edit Penilaian Layanan</h5>

    <form action="{{ route('penilaian.update', $penilaian->penilaian_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Pengaduan</label>
            <input type="text" class="form-control"
                   value="#{{ $penilaian->pengaduan->pengaduan_id ?? '-' }} - {{ $penilaian->pengaduan->judul ?? '-' }}"
                   disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Rating</label>
            <select name="rating" class="form-select" required>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ $penilaian->rating == $i ? 'selected' : '' }}>
                        {{ $i }} ⭐
                    </option>
                @endfor
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Komentar</label>
            <textarea name="komentar" rows="4" class="form-control"
                      placeholder="Tulis komentar (opsional)">{{ $penilaian->komentar }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('penilaian.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
    </form>
  </div>
</div>
@endsection
