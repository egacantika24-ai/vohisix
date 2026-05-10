<!-- Footer -->
@if(Auth::user()->role === 'siswa')
    @include('siswa.partials.footer')
@else
    <footer class="admin-footer">
        <div class="footer-container">
            <p>&copy; {{ date('Y') }} Website Booking PKL. All rights reserved.</p>
        </div>
    </footer>
@endif
