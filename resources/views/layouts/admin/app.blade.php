<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Dashboard') - Sistem Pengaduan Masyarakat</title>

  <link rel="shortcut icon" type="image/png" href="{{ asset('assets-admin/images/logos/favicon.png') }}" />
  <link rel="stylesheet" href="{{ asset('assets-admin/css/styles.min.css') }}" />

  @stack('css')
</head>

<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">

    @include('layouts.admin.sidebar')
    <div class="body-wrapper">
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="{{ asset('assets-admin/images/profile/user-1.jpg') }}" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">{{ Auth::user()->name ?? 'Pengguna' }}</p>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="mx-3 mt-2 d-block">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary w-100">Logout</button>
                    </form>

                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <div class="container-fluid">
        @yield('content')

        <div class="py-6 px-6 text-center">
            <p class="mb-0 fs-4">Design and Developed by <b>Salsabilla Dheawan Shenza</b> Distributed by <a href="https://themewagon.com">ThemeWagon</a></p>
        </div>
      </div>

    </div>
  </div>

  <script src="{{ asset('assets-admin/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets-admin/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets-admin/js/sidebarmenu.js') }}"></script>
  <script src="{{ asset('assets-admin/js/app.min.js') }}"></script>
  <script src="{{ asset('assets-admin/libs/simplebar/dist/simplebar.js') }}"></script>

  @stack('scripts-bottom')
</body>
</html>
