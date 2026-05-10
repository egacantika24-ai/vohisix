<!-- Navbar -->
<nav class="navbar">
    <div class="navbar-left">
        <button class="hamburger" id="hamburger" aria-label="Toggle sidebar">☰</button>
        <a href="{{ url('/') }}" class="navbar-brand">
            <img src="{{ asset('images/logo-vohisix.png') }}" alt="VOHISIX Logo" class="navbar-logo" onerror="this.style.display='none'">
            <span class="navbar-title">
                @if(Auth::user()->role === 'admin')
                    VOHISIX Admin
                @else
                    Website Booking PKL
                @endif
            </span>
        </a>
    </div>
    <div class="navbar-right">
        <span>Halo, {{ Auth::user()->name }}</span>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</nav>
