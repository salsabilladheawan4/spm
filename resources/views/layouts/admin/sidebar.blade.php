<aside class="left-sidebar">
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between p-y px-4 py-4">
            <a href="{{ route('dashboard') }}" class="text-nowrap logo-img">
                <img src="{{ asset('assets-admin/images/logos/suararakyat-logo.png') }}" width="150" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>

        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">

                {{-- SEMUA ROLE: DASHBOARD --}}
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                       href="{{ route('dashboard') }}">
                        <span><i class="ti ti-layout-dashboard"></i></span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                {{-- MENU UTAMA (BERDASARKAN ROLE) --}}
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Menu Utama</span>
                </li>

                {{-- KHUSUS ADMIN --}}
                @if(Auth::user()->role == 'admin')
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->routeIs('kategori.*') ? 'active' : '' }}"
                       href="{{ route('kategori.index') }}">
                        <span><i class="ti ti-category"></i></span>
                        <span class="hide-menu">Data Kategori</span>
                    </a>
                </li>
                @endif

                {{-- ADMIN & STAFF: MANAJEMEN PENGADUAN & WARGA --}}
                @if(in_array(Auth::user()->role, ['admin', 'staff']))
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->routeIs('pengaduan.index', 'pengaduan.show') ? 'active' : '' }}"
                       href="{{ route('pengaduan.index') }}">
                        <span><i class="ti ti-file-description"></i></span>
                        <span class="hide-menu">Data Pengaduan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->routeIs('tindak-lanjut.create') ? 'active' : '' }}"
                        href="{{ route('tindak-lanjut.create') }}">
                        <span><i class="ti ti-edit"></i></span>
                        <span class="hide-menu">Input Tindak Lanjut</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->routeIs('penilaian.index') ? 'active' : '' }}"
                       href="{{ route('penilaian.index') }}">
                        <span><i class="ti ti-star"></i></span>
                        <span class="hide-menu">Ulasan Layanan</span>
                    </a>
                </li>
                @endif

                {{-- KHUSUS WARGA: BUAT PENGADUAN & LIHAT PROGRES --}}
                @if(Auth::user()->role == 'warga')
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->routeIs('pengaduan.create') ? 'active' : '' }}"
                       href="{{ route('pengaduan.create') }}">
                        <span><i class="ti ti-plus"></i></span>
                        <span class="hide-menu">Buat Pengaduan</span>
                    </a>
                </li>
                {{-- Kamu bisa tambahkan menu "Laporanku" di sini nanti --}}
                @endif

                {{-- PENGATURAN --}}
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Pengaturan</span>
                </li>

                {{-- KHUSUS ADMIN: MANAJEMEN USER --}}
                @if(Auth::user()->role == 'admin')
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->routeIs('user.*') ? 'active' : '' }}"
                       href="{{ route('user.index') }}">
                        <span><i class="ti ti-user-cog"></i></span>
                        <span class="hide-menu">Manajemen User</span>
                    </a>
                </li>
                @endif

                <li class="sidebar-item">
                    <a class="sidebar-link"
                       href="#"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span><i class="ti ti-logout"></i></span>
                        <span class="hide-menu">Logout</span>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
