@extends('layouts.admin.app')

@section('title', 'Buat Penilaian Layanan')

@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title fw-semibold mb-4">Form Penilaian Layanan</h5>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('penilaian.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Pilih Pengaduan</label>
            <select name="pengaduan_id" class="form-select" required>
                <option value="">-- Pilih Pengaduan --</option>
                @foreach($pengaduan as $p)
                    <option value="{{ $p->pengaduan_id }}">
                        #{{ $p->pengaduan_id }} - {{ $p->judul }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Rating</label>
            <select name="rating" class="form-select" required>
                <option value="">-- Pilih Rating --</option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">{{ $i }} ⭐</option>
                @endfor
            </select>
        </div>

        <div class="mb-4">
            <label class="form-label">Komentar (Opsional)</label>
            <textarea name="komentar" class="form-control" rows="4"
                      placeholder="Tulis komentar anda..."></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Penilaian</button>
        <a href="{{ route('penilaian.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
    </form>
  </div>
</div>
@endsection
