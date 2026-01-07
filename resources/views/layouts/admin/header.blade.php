<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link nav-icon-hover position-relative"
                    href="{{ route('notifications.index') }}">

                    <i class="ti ti-bell-ringing"></i>

                    @if(auth()->user()->unreadNotifications->count() > 0)
                    <span class="notification bg-danger rounded-circle"></span>
                    @endif
                </a>
            </li>