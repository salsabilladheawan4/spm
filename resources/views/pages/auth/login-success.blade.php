<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Berhasil - Sistem Pengaduan Masyarakat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">Login Berhasil!</h4>
                    </div>
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-check-circle text-success" style="font-size: 3rem;"></i>
                        </div>
                        <h5>Form Login Berhasil Diproses!</h5>
                        <p class="text-muted">Data yang Anda input telah diterima sistem.</p>

                        <div class="mt-4">
                            <p><strong>Data yang dikirim:</strong></p>
                            <ul class="list-unstyled">
                                <li>Username: <strong>{{ $username }}</strong></li>
                                <li>Password: <strong>{{ $password }}</strong></li>
                            </ul>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <a href="/auth" class="btn btn-outline-primary">
                                <i class="fas fa-arrow-left"></i> Kembali ke Login
                            </a>
                            <a href="/admin/inventaris" class="btn btn-success">
                                <i class="fas fa-warehouse"></i> Kelola Inventaris
                            </a>
                            <a href="/dashboard" class="btn btn-info">
                                <i class="fas fa-tachometer-alt"></i> Lihat Dashboard
                            </a>
                            <a href="/profile" class="btn btn-warning">
                                <i class="fas fa-user"></i> Profil Pengguna
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>
</html>
