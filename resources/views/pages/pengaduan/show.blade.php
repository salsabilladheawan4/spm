@extends('layouts.admin.app')

@section('title', 'Detail Pengaduan')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold">Tiket #{{ $pengaduan->nomor_tiket }}</h5>
                <span class="badge bg-primary mb-3">{{ $pengaduan->status }}</span>

                <table class="table table-borderless">
                    <tr>
                        <td width="150"><strong>Pelapor</strong></td>
                        <td>: {{ $pengaduan->warga->nama }}</td>
                    </tr>
                    <tr>
                        <td><strong>Kategori</strong></td>
                        <td>: {{ $pengaduan->kategori->nama }}</td>
                    </tr>
                    <tr>
                        <td><strong>Tanggal</strong></td>
                        <td>: {{ $pengaduan->created_at->format('d M Y, H:i') }}</td>
                    </tr>
                     <tr>
                        <td><strong>Lokasi</strong></td>
                        <td>: {{ $pengaduan->lokasi_text }} (RT {{ $pengaduan->rt }}/RW {{ $pengaduan->rw }})</td>
                    </tr>
                </table>
                <hr>
                <h6><strong>{{ $pengaduan->judul }}</strong></h6>
                <p>{{ $pengaduan->deskripsi }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-3">Bukti Lampiran</h5>
                @php
                    $foto = $pengaduan->media->first(); // Mengambil foto pertama
                @endphp

                @if($foto)
                    <img src="{{ asset('storage/' . $foto->file_url) }}" class="img-fluid rounded" alt="Bukti Foto">
                    <p class="text-muted small mt-2">{{ $foto->caption }}</p>
                @else
                    <div class="alert alert-secondary">Tidak ada lampiran foto.</div>
                @endif
            </div>
        </div>
        <a href="{{ route('pengaduan.index') }}" class="btn btn-outline-secondary w-100">Kembali</a>
    </div>
</div>
@endsection
