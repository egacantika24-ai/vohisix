<!-- Top Navigation Bar -->
<nav class="navbar-dudi">
    <div class="nav-left">
        <button class="nav-hamburger" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>
        <span class="nav-title">Pencarian DUDI</span>
    </div>
</nav>

<!-- Sidebar Navigation -->
<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>
<nav class="sidebar-nav" id="sidebarNav">
    <div class="sidebar-nav-header">
        <span class="sidebar-nav-title">Menu</span>
        <button class="sidebar-close" onclick="closeSidebar()">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <ul class="sidebar-nav-items">
        <li class="sidebar-nav-item">
            <a href="{{ route('siswa.dashboard') }}" class="sidebar-nav-link">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="sidebar-nav-item">
            <a href="{{ route('siswa.dudi.index') }}" class="sidebar-nav-link active">
                <i class="fas fa-briefcase"></i>
                <span>Cari DUDI</span>
            </a>
        </li>
        <li class="sidebar-nav-item">
            <a href="{{ route('siswa.booking.index') }}" class="sidebar-nav-link">
                <i class="fas fa-calendar-check"></i>
                <span>Status Pengajuan</span>
            </a>
        </li>
        <li class="sidebar-nav-item">
            <a href="{{ route('siswa.profile.index') }}" class="sidebar-nav-link">
                <i class="fas fa-file-upload"></i>
                <span>Profil</span>
            </a>
        </li>
        <li class="sidebar-nav-item" style="margin-top: 20px; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 20px;">
            <form method="POST" action="{{ route('logout') }}" style="display: inline-width: 100%;">
                @csrf
                <button type="submit" class="sidebar-nav-link" style="width: 100%; text-align: left; cursor: pointer;">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </form>
        </li>
    </ul>
</nav>