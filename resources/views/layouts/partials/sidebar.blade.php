<!-- Sidebar Overlay -->
<div class="sidebar-overlay" id="sidebar-overlay"></div>

<!-- Sidebar -->
<aside class="sidebar" id="sidebar" aria-label="Sidebar navigation">
    <div class="sidebar-inner">
        <div class="profile-card">
            <div class="avatar-circle">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            <div class="profile-details">
                <div class="profile-name">{{ Auth::user()->name }}</div>
                <div class="profile-meta">
                    @if(Auth::user()->role === 'admin')
                        Admin VOHISIX
                    @else
                        Siswa PKL
                    @endif
                </div>
            </div>
        </div>

        <nav class="sidebar-nav">
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="sidebar-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span class="nav-icon">📊</span> Dashboard
                </a>
                <a href="{{ route('admin.siswa.index') }}" class="sidebar-nav-item {{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}">
                    <span class="nav-icon">👥</span> Data Siswa
                </a>
                <a href="{{ route('admin.dudi.index') }}" class="sidebar-nav-item {{ request()->routeIs('admin.dudi.*') ? 'active' : '' }}">
                    <span class="nav-icon">🏢</span> Perusahaan DUDI
                </a>
                <a href="{{ route('admin.booking.index') }}" class="sidebar-nav-item {{ request()->routeIs('admin.booking.*') ? 'active' : '' }}">
                    <span class="nav-icon">📋</span> Booking PKL
                </a>
                <a href="{{ route('admin.login.index') }}" class="sidebar-nav-item {{ request()->routeIs('admin.login.*') ? 'active' : '' }}">
                    <span class="nav-icon">🔐</span> Manajemen Login
                </a>
            @else
                <a href="{{ route('siswa.dashboard') }}" class="sidebar-nav-item {{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}">
                    <span class="nav-icon">📊</span> Dashboard
                </a>
                <a href="{{ route('siswa.profile.index') }}" class="sidebar-nav-item {{ request()->routeIs('siswa.profile.*') ? 'active' : '' }}">
                    <span class="nav-icon">📝</span> Profil
                </a>
                <a href="{{ route('siswa.dudi.index') }}" class="sidebar-nav-item {{ request()->routeIs('siswa.dudi.*') ? 'active' : '' }}">
                    <span class="nav-icon">🏢</span> Cari DUDI
                </a>
                <a href="{{ route('siswa.booking.index') }}" class="sidebar-nav-item {{ request()->routeIs('siswa.booking.*') ? 'active' : '' }}">
                    <span class="nav-icon">📋</span> Status Pengajuan
                </a>
            @endif
        </nav>

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                @csrf
                <button type="submit" class="logout-btn">
                    <span class="nav-icon">↩</span> Logout
                </button>
            </form>
        </div>
    </div>
</aside>
