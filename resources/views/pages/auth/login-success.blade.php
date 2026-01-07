<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1200">
    <title>Login Berhasil - Sistem Pengaduan Masyarakat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #e9f7ef;
            font-size: 18px;
        }
        .card {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 50px;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .icon-section {
            flex: 1;
            text-align: center;
        }
        .icon-section i {
            font-size: 6rem;
            color: #28a745;
        }
        .info-section {
            flex: 2;
        }
        .info-section h4 {
            font-size: 28px;
        }
        .info-section h5 {
            font-size: 22px;
        }
        .list-unstyled li {
            font-size: 18px;
            margin-bottom: 8px;
        }
        .btn {
            font-size: 18px;
            padding: 12px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-10">
                <div class="card">
                    <!-- Icon kiri -->
                    <div class="icon-section">
                        <i class="fas fa-check-circle"></i>
                    </div>

                    <!-- Info kanan -->
                    <div class="info-section">
                        <h4>Login Berhasil!</h4>
                        <h5>Form Login Berhasil Diproses!</h5>
                        <p class="text-muted">Data yang Anda input telah diterima sistem.</p>

                        <ul class="list-unstyled">
                            <li>Username: <strong>{{ $username }}</strong></li>
                            <li>Password: <strong>{{ $password }}</strong></li>
                        </ul>

                        <div class="d-grid gap-2 mt-3">
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
</body>
</html>
