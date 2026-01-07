<!doctype html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=1200"> <!-- paksa landscape -->
  <title>Login - Sistem Informasi Pengaduan Masyarakat</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    body {
      font-size: 18px;
      background-color: #f5f7fa;
    }

    .card {
      display: flex;
      flex-direction: row; /* landscape */
      align-items: center;
      gap: 50px;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .logo-section {
      flex: 1;
      text-align: center;
    }

    .logo-section img {
      width: 180px;
      margin-bottom: 20px;
    }

    .form-section {
      flex: 2;
    }

    .form-control {
      height: 50px;
      font-size: 16px;
    }

    .btn {
      font-size: 18px;
      padding: 12px;
    }

    .text-center.fs-4 {
      font-size: 20px;
    }
  </style>
</head>

<body>
  <div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-12 col-xl-10">
        <div class="card">
          <!-- Logo kiri -->
          <div class="logo-section">
            <a href="{{ url('/') }}">
              <img src="{{ asset('assets-admin/images/logos/suararakyat.png') }}" alt="Logo">
            </a>
            <p>Sistem Informasi Pengaduan Masyarakat</p>
          </div>

          <!-- Form kanan -->
          <div class="form-section">
            <form action="{{ route('login.submit') }}" method="POST">
              @csrf
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                  placeholder="Masukkan email">
              </div>
              <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}"
                  placeholder="Masukkan password">
              </div>

              <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="form-check">
                  <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                  <label class="form-check-label text-dark" for="flexCheckChecked">
                    Remember this Device
                  </label>
                </div>
                <a class="text-primary fw-bold" href="#">Forgot Password?</a>
              </div>

              <button type="submit" class="btn btn-primary w-100 mb-4 rounded-2">
                <i class="fas fa-sign-in-alt"></i> Sign In
              </button>

              <div class="d-flex align-items-center justify-content-center">
                <p class="fs-5 mb-0 fw-bold">New to Sistem?</p>
                <a class="text-primary fw-bold ms-2 fs-5" href="{{ route('register') }}">Create an account</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
