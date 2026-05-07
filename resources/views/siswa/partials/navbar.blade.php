<!-- Navbar -->
<nav class="navbar">
    <div class="nav-container">
        <div class="nav-left">
            <button class="hamburger-btn" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <div class="nav-logo-container">
                <img src="{{ asset('images/logo-vohisix.png') }}" alt="VOHISIX Logo" class="nav-logo-img">
            </div>
        </div>
        <div class="nav-right">
            <div class="user-greeting">
                <div class="user-avatar">{{ strtoupper(substr($siswa->nama, 0, 1)) }}</div>
                <span>Halo, {{ $siswa->nama }}</span>
            </div>
        </div>
    </div>
</nav>

<!-- Sidebar -->
<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>
<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-user-avatar">{{ strtoupper(substr($siswa->nama, 0, 1)) }}</div>
        <div class="sidebar-user-name">{{ $siswa->nama }}</div>
        <div class="sidebar-user-role">{{ $siswa->kelas }}</div>
    </div>
    <div class="sidebar-nav">
        <a href="{{ route('siswa.dashboard') }}" class="sidebar-nav-item {{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}">
            <i class="fas fa-home"></i>Dashboard
        </a>
        <a href="{{ route('siswa.profile.index') }}" class="sidebar-nav-item {{ request()->routeIs('siswa.profile.*') ? 'active' : '' }}">
            <i class="fas fa-file-alt"></i>Profile
        </a>
        <a href="{{ route('siswa.dudi.index') }}" class="sidebar-nav-item {{ request()->routeIs('siswa.dudi.*') ? 'active' : '' }}">
            <i class="fas fa-building"></i>Cari DUDI
        </a>
        <a href="{{ route('siswa.booking.index') }}" class="sidebar-nav-item {{ request()->routeIs('siswa.booking.*') ? 'active' : '' }}">
            <i class="fas fa-clipboard-list"></i>Status Pengajuan
        </a>
    </div>
    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>
</div>