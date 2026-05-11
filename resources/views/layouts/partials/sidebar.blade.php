<div class="sidebar-overlay" id="sidebar-overlay"></div>

<aside class="sidebar" id="sidebar" aria-label="Sidebar navigation">
    <div class="sidebar-header">
        <div class="sidebar-user-avatar">
            {{ Auth::check() ? strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) : 'U' }}
        </div>
        <h2 class="sidebar-user-name">{{ Auth::check() ? Auth::user()->name : 'Pengguna' }}</h2>
        <p class="sidebar-user-role">
            @if(Auth::check() && Auth::user()->role === 'admin')
                Admin PKL
            @elseif(Auth::check() && Auth::user()->role === 'siswa')
                Siswa {{ Auth::user()->siswa->nis ?? 'PKL' }}
            @else
                Pengguna
            @endif
        </p>
    </div>

    <nav class="sidebar-nav">
        @if(Auth::check() && Auth::user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}" class="sidebar-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-th"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.siswa.index') }}" class="sidebar-nav-item {{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span>Data Siswa</span>
            </a>
            <a href="{{ route('admin.dudi.index') }}" class="sidebar-nav-item {{ request()->routeIs('admin.dudi.*') ? 'active' : '' }}">
                <i class="fas fa-building"></i>
                <span>Data DUDI</span>
            </a>
            <a href="{{ route('admin.booking.index') }}" class="sidebar-nav-item {{ request()->routeIs('admin.booking.*') ? 'active' : '' }}">
                <i class="fas fa-calendar"></i>
                <span>Booking PKL</span>
            </a>
            <a href="{{ route('admin.login.index') }}" class="sidebar-nav-item {{ request()->routeIs('admin.login.*') ? 'active' : '' }}">
                <i class="fas fa-user-shield"></i>
                <span>Manajemen Login</span>
            </a>
        @elseif(Auth::check() && Auth::user()->role === 'siswa')
            <a href="{{ route('siswa.dashboard') }}" class="sidebar-nav-item {{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}">
                <i class="fas fa-th"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('siswa.profile.index') }}" class="sidebar-nav-item {{ request()->routeIs('siswa.profile.*') ? 'active' : '' }}">
                <i class="fas fa-user"></i>
                <span>Profil</span>
            </a>
            <a href="{{ route('siswa.dudi.index') }}" class="sidebar-nav-item {{ request()->routeIs('siswa.dudi.*') ? 'active' : '' }}">
                <i class="fas fa-search"></i>
                <span>Cari DUDI</span>
            </a>
            <a href="{{ route('siswa.booking.index') }}" class="sidebar-nav-item {{ request()->routeIs('siswa.booking.*') ? 'active' : '' }}">
                <i class="fas fa-file"></i>
                <span>Status Pengajuan</span>
            </a>
        @endif
    </nav>

    <div class="sidebar-footer">
        @if(Auth::check())
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-nav-item" style="width: 100%; border: none; background: none; padding: 15px 18px; cursor: pointer; text-align: left;">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </form>
        @endif
    </div>
</aside>
        {# Profile Card - Langsung di atas, tanpa logo #}
        <div class="mb-8">
            <div class="profile-card p-6 rounded-2xl shadow-lg">
                {# Avatar Clickable #}
                <div class="w-16 h-16 bg-white rounded-full mx-auto mb-3 border-4 border-white/30 shadow-inner overflow-hidden clickable-avatar">
                    <div class="w-full h-full flex items-center justify-center text-2xl font-bold text-[#003056]">
                        {{ Auth::check() ? strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) : 'U' }}
                    </div>
                </div>
                <h2 class="text-center font-bold text-white text-lg font-display">{{ Auth::check() ? Auth::user()->name : 'Pengguna' }}</h2>
                <p class="text-center text-xs text-blue-200 tracking-wider font-semibold">
                    @if(Auth::check() && Auth::user()->role === 'admin')
                        Admin PKL
                    @elseif(Auth::check() && Auth::user()->role === 'siswa')
                        Siswa {{ Auth::user()->siswa->nis ?? 'PKL' }}
                    @else
                        Pengguna
                    @endif
                </p>
                <div class="mt-4 flex justify-center">
                    <span class="px-3 py-1 bg-white/20 text-white rounded-full text-[10px] font-bold uppercase tracking-tighter shadow-sm border border-white/30">
                        @if(Auth::check() && Auth::user()->role === 'admin')
                            Admin
                        @elseif(Auth::check() && Auth::user()->role === 'siswa')
                            {{ Auth::user()->siswa->kelas ?? 'Siswa' }}
                        @else
                            Pengguna
                        @endif
                    </span>
                </div>
            </div>
        </div>

        {# Navigation Menu #}
        <nav class="space-y-2">
            @if(Auth::check() && Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-6 py-4 rounded-2xl text-sm transition-all shadow-sm border {{ request()->routeIs('admin.dashboard') ? 'bg-white text-[#003056] font-bold border-white/60 shadow-md' : 'text-slate-500 hover:bg-white/30 hover:text-[#003056] font-semibold border-transparent' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.siswa.index') }}" class="flex items-center gap-3 px-6 py-4 rounded-2xl text-sm transition-all shadow-sm border {{ request()->routeIs('admin.siswa.*') ? 'bg-white text-[#003056] font-bold border-white/60 shadow-md' : 'text-slate-500 hover:bg-white/30 hover:text-[#003056] font-semibold border-transparent' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    Data Siswa
                </a>
                <a href="{{ route('admin.dudi.index') }}" class="flex items-center gap-3 px-6 py-4 rounded-2xl text-sm transition-all shadow-sm border {{ request()->routeIs('admin.dudi.*') ? 'bg-white text-[#003056] font-bold border-white/60 shadow-md' : 'text-slate-500 hover:bg-white/30 hover:text-[#003056] font-semibold border-transparent' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="4" y="2" width="16" height="20" rx="2" ry="2"></rect>
                        <path d="M9 22v-4h6v4"></path>
                    </svg>
                    Data DUDI
                </a>
                <a href="{{ route('admin.booking.index') }}" class="flex items-center gap-3 px-6 py-4 rounded-2xl text-sm transition-all shadow-sm border {{ request()->routeIs('admin.booking.*') ? 'bg-white text-[#003056] font-bold border-white/60 shadow-md' : 'text-slate-500 hover:bg-white/30 hover:text-[#003056] font-semibold border-transparent' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                    Booking PKL
                </a>
                <a href="{{ route('admin.login.index') }}" class="flex items-center gap-3 px-6 py-4 rounded-2xl text-sm transition-all shadow-sm border {{ request()->routeIs('admin.login.*') ? 'bg-white text-[#003056] font-bold border-white/60 shadow-md' : 'text-slate-500 hover:bg-white/30 hover:text-[#003056] font-semibold border-transparent' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    Manajemen Login
                </a>
            @elseif(Auth::check() && Auth::user()->role === 'siswa')
                <a href="{{ route('siswa.dashboard') }}" class="flex items-center gap-3 px-6 py-4 rounded-2xl text-sm transition-all shadow-sm border {{ request()->routeIs('siswa.dashboard') ? 'bg-white text-[#003056] font-bold border-white/60 shadow-md' : 'text-slate-500 hover:bg-white/30 hover:text-[#003056] font-semibold border-transparent' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('siswa.profile.index') }}" class="flex items-center gap-3 px-6 py-4 rounded-2xl text-sm transition-all shadow-sm border {{ request()->routeIs('siswa.profile.*') ? 'bg-white text-[#003056] font-bold border-white/60 shadow-md' : 'text-slate-500 hover:bg-white/30 hover:text-[#003056] font-semibold border-transparent' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    Profil
                </a>
                <a href="{{ route('siswa.dudi.index') }}" class="flex items-center gap-3 px-6 py-4 rounded-2xl text-sm transition-all shadow-sm border {{ request()->routeIs('siswa.dudi.*') ? 'bg-white text-[#003056] font-bold border-white/60 shadow-md' : 'text-slate-500 hover:bg-white/30 hover:text-[#003056] font-semibold border-transparent' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="4" y="2" width="16" height="20" rx="2" ry="2"></rect>
                        <path d="M9 22v-4h6v4"></path>
                    </svg>
                    Cari DUDI
                </a>
                <a href="{{ route('siswa.booking.index') }}" class="flex items-center gap-3 px-6 py-4 rounded-2xl text-sm transition-all shadow-sm border {{ request()->routeIs('siswa.booking.*') ? 'bg-white text-[#003056] font-bold border-white/60 shadow-md' : 'text-slate-500 hover:bg-white/30 hover:text-[#003056] font-semibold border-transparent' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                    Status Pengajuan
                </a>
            @endif
        </nav>
    </div>
    
    {# Logout Button - Rata Kiri, sejajar dengan menu #}
    @if(Auth::check())
        <div class="mt-auto p-8 border-t border-slate-200/50">
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" class="flex items-center gap-3 text-red-600 hover:text-red-700 hover:bg-red-50 transition-colors font-semibold text-sm py-3 px-6 rounded-xl w-full">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    Keluar Akun
                </button>
            </form>
        </div>
    @endif
</aside>
