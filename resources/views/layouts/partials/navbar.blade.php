<!-- Navbar -->
<nav class="navbar" style="background-color: #003056 !important;">
    <div class="navbar-left">
        <button class="hamburger" id="hamburger">☰</button>
        <div class="navbar-title">
            @if(Auth::user()->role === 'admin')
                vohisix_admin
            @else
                Website Booking PKL
            @endif
        </div>
    </div>
    <div class="navbar-right">
        <span>Halo, {{ Auth::user()->name }}</span>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</nav>
