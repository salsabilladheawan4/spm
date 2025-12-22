@extends('layouts.admin.app')


@section('title', 'Tambah User')


@section('content')
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">Tambah User Baru</h5>


            <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- KIRI -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select name="role" class="form-select" required>
                                <option value="">-- Pilih Role --</option>
                                <option value="admin">Administrator</option>
                                <option value="staff">Petugas</option>
                                <option value="warga">Warga</option>
                            </select>
                        </div>
                    </div>


                    <!-- KANAN -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Foto Profil</label>
                            <input type="file" name="profile_photo"
                                class="form-control @error('profile_photo') is-invalid @enderror">
                            @error('profile_photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>


                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('user.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan User</button>
                </div>
            </form>
        </div>
    </div>
@endsection
