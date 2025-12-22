@extends('layouts.admin.app')

@section('title', 'Edit User')

@section('content')
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">Edit User</h5>

            <form action="{{ route('user.update', $dataUser->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- KIRI -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ old('name', $dataUser->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', $dataUser->email) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select name="role" class="form-select" required>
                                <option value="">-- Pilih Role --</option>
                                <option value="admin" {{ old('role', $dataUser->role) == 'admin' ? 'selected' : '' }}>
                                    Administrator</option>
                                <option value="staff" {{ old('role', $dataUser->role) == 'staff' ? 'selected' : '' }}>
                                    Petugas</option>
                                <option value="warga" {{ old('role', $dataUser->role) == 'warga' ? 'selected' : '' }}>Warga
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- KANAN -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Password <small class="text-muted">(Kosongkan jika tidak
                                    diubah)</small></label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Foto Profil Saat Ini</label>
                            <div class="mb-2">
                                @if ($dataUser->profile_photo)
                                    <img src="{{ asset('uploads/profile_pictures/' . $dataUser->profile_photo) }}"
                                        width="100" class="rounded shadow-sm">
                                @else
                                    <p class="text-muted">Belum ada foto.</p>
                                @endif
                            </div>
                            <input type="file" name="profile_photo" class="form-control">
                            <small class="text-muted">Kosongkan jika tidak ingin mengubah foto.</small>
                        </div>

                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('user.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Update User</button>
                </div>
            </form>
        </div>
    </div>
@endsection
