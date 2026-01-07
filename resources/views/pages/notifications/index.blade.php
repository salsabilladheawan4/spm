@extends('layouts.admin.app')

@section('content')
<div class="container-fluid">

    <h4 class="mb-4">
        <i class="ti ti-bell"></i> Notifikasi
    </h4>

    @forelse ($notifications as $notification)
        <div class="card mb-3 shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-start">

                <div>
                    <h6 class="mb-1 fw-bold">
                        {{ $notification->data['title'] ?? 'Notifikasi' }}
                    </h6>

                    <p class="mb-2 text-muted">
                        {{ $notification->data['message'] ?? '-' }}
                    </p>

                    <small class="text-secondary">
                        {{ $notification->created_at->diffForHumans() }}
                    </small>
                </div>

                @if(!empty($notification->data['url']))
                    <a href="{{ $notification->data['url'] }}"
                       class="btn btn-sm btn-primary">
                        Lihat
                    </a>
                @endif

            </div>
        </div>
    @empty
        <div class="alert alert-info">
            Tidak ada notifikasi
        </div>
    @endforelse

</div>
@endsection
