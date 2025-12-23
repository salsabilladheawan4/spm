@extends('layouts.admin.app')

@section('title', 'Detail Pelayanan')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold">Pelayanan #{{ $pelayanan->nomor_tiket ?? $pelayanan->id }}</h5>
                <span class="badge
                    @php
                        $badges = [
                            'pending' => 'bg-secondary',
                            'verifikasi' => 'bg-info',
                            'proses' => 'bg-warning',
                            'selesai' => 'bg-success',
                            'ditolak' => 'bg-danger'
                        ];
                    @endphp
                    {{ $badges[$pelayanan->status] ?? 'bg-secondary' }}">
                    {{ ucfirst($pelayanan->status) }}
                </span>

                <table class="table table-borderless mt-3">
                    <tr>
                        <td width="150"><strong>Pemohon</strong></td>
                        <td>: {{ $pelayanan->nama_pelapor }}</td>
                    </tr>
                    <tr>
                        <td><strong>Kategori</strong></td>
                        <td>: {{ $pelayanan->kategori->nama }}</td>
                    </tr>
                    <tr>
                        <td><strong>Tanggal</strong></td>
                        <td>: {{ $pelayanan->created_at->format('d M Y, H:i') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Lokasi</strong></td>
                        <td>: {{ $pelayanan->lokasi_text ?? '-' }} (RT {{ $pelayanan->rt ?? '-' }}/RW {{ $pelayanan->rw ?? '-' }})</td>
                    </tr>
                </table>

                <hr>
                <h6><strong>{{ $pelayanan->judul }}</strong></h6>
                <p>{{ $pelayanan->deskripsi }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-3">Bukti Lampiran</h5>
                @php
                    $foto = $pelayanan->media->first(); // Mengambil lampiran pertama
                @endphp

                @if($foto)
                    <img src="{{ asset('storage/' . $foto->file_url) }}" class="img-fluid rounded" alt="Bukti Lampiran">
                    <p class="text-muted small mt-2">{{ $foto->caption }}</p>
                @else
                    <div class="alert alert-secondary">Tidak ada lampiran.</div>
                @endif
            </div>
        </div>
        <a href="{{ route('pelayanan.index') }}" class="btn btn-outline-secondary w-100 mt-2">Kembali</a>
    </div>
</div>
@endsection
