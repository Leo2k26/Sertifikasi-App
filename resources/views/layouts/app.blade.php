<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Pengelolaan Data Peserta Sertifikasi')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>

    <div class="app-shell">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar__brand">Menu Sertifikasi</div>
            <nav class="sidebar__nav">
                <a href="{{ route('dashboard') }}"
                    class="sidebar__link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <span class="sidebar__icon"></span> Dashboard
                </a>

                
                @if (!auth()->user()->isAdmin())
                    <a href="{{ route('profile.edit') }}"
                        class="sidebar__link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                        <span class="sidebar__icon"></span> Profil Saya
                    </a>
                @endif

                <a href="{{ route('peserta.index') }}"
                    class="sidebar__link {{ request()->routeIs('peserta.*') ? 'active' : '' }}">
                    <span class="sidebar__icon"></span> Data Peserta
                </a>
                <a href="{{ route('skema.index') }}"
                    class="sidebar__link {{ request()->routeIs('skema.*') ? 'active' : '' }}">
                    <span class="sidebar__icon"></span> Data Skema
                </a>
            </nav>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="sidebar__logout">Logout</button>
            </form>
        </aside>

        <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

        <div class="app-main">
            <header class="topbar">
                <div class="d-flex align-items-center gap-3">
                    <button class="sidebar-toggle" id="sidebarToggle" aria-label="Buka menu">☰</button>
                    <div class="topbar__title">
                        <h1>@yield('page-title', 'Dashboard')</h1>
                        <p>@yield('page-subtitle', '')</p>
                    </div>
                </div>
                <div class="topbar__user">
                    <span>{{ auth()->user()->name }}</span>
                    <span
                        class="role-badge {{ auth()->user()->isAdmin() ? 'role-badge--admin' : '' }}">{{ auth()->user()->role }}</span>
                </div>
            </header>

            <main class="content-area">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebar = document.getElementById('sidebar');
        const backdrop = document.getElementById('sidebarBackdrop');
        const toggleBtn = document.getElementById('sidebarToggle');

        toggleBtn?.addEventListener('click', function() {
            sidebar.classList.toggle('is-open');
            backdrop.classList.toggle('is-open');
        });

        backdrop?.addEventListener('click', function() {
            sidebar.classList.remove('is-open');
            backdrop.classList.remove('is-open');
        });
    </script>
</body>

</html>
