<!-- Footer -->
@if(Auth::check() && Auth::user()->role === 'siswa')
    @include('siswa.partials.footer')
@else
    <footer class="footer-admin">
        <div class="container">
            <p>&copy; {{ date('Y') }} Website Booking PKL. All rights reserved.</p>
        </div>
    </footer>
@endif
