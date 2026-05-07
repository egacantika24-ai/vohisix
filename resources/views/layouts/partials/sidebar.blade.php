<!-- Sidebar Overlay -->
<div class="sidebar-overlay" id="sidebar-overlay"></div>

<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-profile">
            <div class="profile-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            <div class="profile-name">{{ Auth::user()->name }}</div>
            <div class="profile-role">
                @if(Auth::user()->role === 'admin')
                    Admin
                @else
                    Siswa
                @endif
            </div>
        </div>
    </div>

    <ul class="sidebar-menu">
        @if(Auth::user()->role === 'admin')
            <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">📊 Dashboard</a></li>
            <li><a href="{{ route('admin.siswa.index') }}" class="{{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}">👥 Siswa PKL</a></li>
            <li><a href="{{ route('admin.dudi.index') }}" class="{{ request()->routeIs('admin.dudi.*') ? 'active' : '' }}">🏢 Perusahaan (DUDI)</a></li>
            <li><a href="{{ route('admin.booking.index') }}" class="{{ request()->routeIs('admin.booking.*') ? 'active' : '' }}">📋 Booking PKL</a></li>
            <li><a href="{{ route('admin.login.index') }}" class="{{ request()->routeIs('admin.login.*') ? 'active' : '' }}">🔐 Manajemen Login</a></li>
        @else
            <li><a href="{{ route('siswa.dashboard') }}" class="{{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}">📊 Dashboard</a></li>
            <li><a href="{{ route('siswa.profile.index') }}" class="{{ request()->routeIs('siswa.profile.*') ? 'active' : '' }}">📝 Profil Siswa</a></li>
            <li><a href="{{ route('siswa.dudi.index') }}" class="{{ request()->routeIs('siswa.dudi.*') ? 'active' : '' }}">🏢 Perusahaan (DUDI)</a></li>
            <li><a href="{{ route('siswa.booking.index') }}" class="{{ request()->routeIs('siswa.booking.*') ? 'active' : '' }}">📋 Booking PKL</a></li>
        @endif
    </ul>
</aside>
