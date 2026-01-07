@extends('layouts.admin.app')

@section('title', 'Permohonan Staff')

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="fw-semibold mb-4">Daftar Permohonan Staff</h4>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="badge bg-warning text-dark">
                                Pending
                            </span>
                        </td>
                        <td>
                            <form action="{{ route('staff.approve', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-success btn-sm">
                                    Terima
                                </button>
                            </form>

                            <form action="{{ route('staff.reject', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-danger btn-sm">
                                    Tolak
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">
                            Tidak ada permohonan staff
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
