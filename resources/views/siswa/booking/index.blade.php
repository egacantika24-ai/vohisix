@extends('layouts.app')

@section('title', 'Status Booking PKL')

@section('content')
<style>
.profile-hero {
    background: #fff;
    padding: 28px 22px;
    border-radius: 24px;
    box-shadow: 0 24px 60px rgba(15, 74, 86, .06);
    margin-bottom: 30px;
}
.profile-hero h1 {
    margin-bottom: 8px;
    font-size: 2rem;
    color: #003056;
}
.profile-hero p {
    margin-bottom: 24px;
    color: #475569;
    max-width: 720px;
    font-size: 15px;
}
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 18px;
    margin-bottom: 24px;
}
.stat-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    padding: 22px;
    box-shadow: 0 18px 40px rgba(15, 74, 86, .04);
}
.stat-card .stat-label {
    font-size: 11px;
    letter-spacing: .18em;
    text-transform: uppercase;
    color: #64748b;
    margin-bottom: 10px;
}
.stat-card .stat-number {
    font-size: 2rem;
    font-weight: 700;
    color: #003056;
}
.booking-list {
    display: grid;
    gap: 18px;
}
.booking-card {
    background: #fff;
    border-radius: 24px;
    border: 1px solid #e2e8f0;
    padding: 24px;
    box-shadow: 0 20px 45px rgba(15, 74, 86, .05);
}
.booking-card .booking-header {
    display: flex;
    justify-content: space-between;
    gap: 16px;
    flex-wrap: wrap;
    margin-bottom: 18px;
}
.booking-card h3 {
    margin: 0;
    font-size: 1.1rem;
    color: #003056;
}
.booking-card p {
    margin: 0;
    color: #64748b;
    font-size: 14px;
}
.status-pill {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 14px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
}
.status-pill.accept { background: #e6f4ea; color: #1f6d27; }
.status-pill.reject { background: #fde8ec; color: #8a1d2b; }
.status-pill.review { background: #fff4d6; color: #7c5a00; }
.booking-card .meta-row {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #94a3b8;
    font-size: 13px;
}
.booking-card .booking-actions button {
    background: #003056;
    color: #fff;
    border: none;
    border-radius: 14px;
    padding: 12px 18px;
    font-weight: 700;
    cursor: pointer;
    transition: background .2s, transform .2s;
}
.booking-card .booking-actions button:hover {
    background: #002542;
    transform: translateY(-1px);
}
.no-data {
    padding: 50px;
    text-align: center;
    color: #667485;
    font-size: 15px;
}
@media (max-width: 760px) {
    .booking-card .booking-header { flex-direction: column; align-items: flex-start; }
}
</style>

<div class="profile-hero">
    <h1>Status Booking PKL Saya</h1>
    <p>Pantau status pengajuan PKL Anda dengan kartu informasi yang mudah dibaca.</p>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-label">Total Pengajuan</div>
        <div class="stat-number">{{ $bookings->total() }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Diterima</div>
        <div class="stat-number">{{ $bookings->where('status', 'Diterima')->count() ?? 0 }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Ditolak</div>
        <div class="stat-number">{{ $bookings->where('status', 'Ditolak')->count() ?? 0 }}</div>
    </div>
</div>

@if($bookings->count() > 0)
    <div class="booking-list">
        @foreach($bookings as $booking)
            <div class="booking-card">
                <div class="booking-header">
                    <div>
                        <h3>{{ $booking->dudi->nama_dudi }}</h3>
                        <p>{{ $booking->dudi->bidang_usaha }}</p>
                        <p style="margin-top: 10px;">Diajukan: {{ $booking->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <div style="display:flex; flex-direction:column; align-items:flex-end; gap:12px;">
                        @if($booking->status === 'Diterima')
                            <span class="status-pill accept">Accepted</span>
                        @elseif($booking->status === 'Ditolak')
                            <span class="status-pill reject">Declined</span>
                        @else
                            <span class="status-pill review">Reviewing</span>
                        @endif
                        <div class="booking-actions">
                            <button type="button">Lihat Detail</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if($bookings->hasPages())
        <div class="pagination" style="margin: 20px 0; justify-content: center;">
            @if($bookings->onFirstPage())
                <span>← Sebelumnya</span>
            @else
                <a href="{{ $bookings->previousPageUrl() }}">← Sebelumnya</a>
            @endif

            @foreach($bookings->getUrlRange(1, $bookings->lastPage()) as $page => $url)
                @if($page == $bookings->currentPage())
                    <span class="active"><span>{{ $page }}</span></span>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach

            @if($bookings->hasMorePages())
                <a href="{{ $bookings->nextPageUrl() }}">Selanjutnya →</a>
            @else
                <span>Selanjutnya →</span>
            @endif
        </div>
    @endif
@else
    <div class="card" style="padding: 24px; text-align: center;">
        <p class="no-data">Belum ada pengajuan PKL</p>
        <p style="color:#94a3b8; margin-top: 10px;">Silakan ajukan PKL ke perusahaan yang Anda inginkan di halaman Perusahaan (DUDI).</p>
        <a href="{{ route('siswa.dudi.index') }}" class="btn btn-primary" style="margin-top: 18px; display: inline-block; border-radius: 14px; padding: 12px 24px;">Cari Perusahaan</a>
    </div>
@endif
@endsection
