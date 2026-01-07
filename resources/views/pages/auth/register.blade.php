<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1200">
    <title>Register - Sistem Pengaduan Masyarakat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f5f7fa;
            font-size: 18px;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: row; /* landscape */
            align-items: center;
            padding: 40px;
            gap: 50px;
        }
        .card img {
            width: 220px;
        }
        .form-control {
            height: 50px;
            font-size: 16px;
        }
        .btn {
            font-size: 18px;
            padding: 12px;
        }
        .form-section {
            flex: 2;
        }
        .logo-section {
            flex: 1;
            text-align: center;
        }
        .logo-section p {
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-10">
                <div class="card">
                    <!-- Logo / gambar kiri -->
                    <div class="logo-section">
                        <img src="{{ asset('assets-admin/images/logos/suararakyat.png') }}" alt="Logo">
                        <p>Sistem Informasi Pengaduan Masyarakat</p>
                    </div>

                    <!-- Form kanan -->
                    <div class="form-section">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif

                        <form action="{{ route('register.submit') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mb-3">
                                <i class="fas fa-user-plus"></i> Sign Up
                            </button>

                            <div class="d-flex align-items-center justify-content-center mt-3">
                                <p class="fs-5 mb-0 fw-bold">Already have an Account?</p>
                                <a class="text-primary fw-bold ms-2 fs-5" href="{{ route('auth.login') }}">Sign In</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
