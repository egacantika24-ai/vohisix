@extends('layouts.app')

@section('title', 'Booking PKL')

@section('content')
<style>
.booking-hero {
    background: linear-gradient(135deg, #003056 0%, #0b416a 100%);
    border-radius: 24px;
    color: #fff;
    padding: 32px 28px;
    margin-bottom: 32px;
    overflow: hidden;
}
.booking-hero h1 {
    margin-bottom: 8px;
    font-size: 2.25rem;
    line-height: 1.05;
}
.booking-hero p {
    margin-bottom: 24px;
    color: rgba(255,255,255,0.87);
    max-width: 720px;
}
.booking-hero .hero-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    gap: 18px;
}
.hero-stat {
    background: rgba(255,255,255,.12);
    border: 1px solid rgba(255,255,255,.18);
    border-radius: 20px;
    padding: 18px 20px;
}
.hero-stat strong {
    display: block;
    font-size: 1.95rem;
    line-height: 1.05;
    margin-bottom: 6px;
}
.hero-stat span {
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: .2em;
    color: rgba(255,255,255,.8);
}
.section-title {
    display: flex;
    justify-content: space-between;
    gap: 16px;
    align-items: flex-start;
    flex-wrap: wrap;
    margin-bottom: 14px;
}
.section-title h2 {
    margin: 0;
    font-size: 1.35rem;
    color: #fff;
}
.toolbar-panel {
    background: #f4f8fd;
    border: 1px solid #d8e5f4;
    border-radius: 18px;
    padding: 22px;
    margin-bottom: 20px;
}
.toolbar-grid {
    display: grid;
    grid-template-columns: 1fr minmax(180px,220px) minmax(180px,220px) minmax(140px,180px);
    gap: 14px;
    align-items: center;
}
.toolbar-grid input,
.toolbar-grid select {
    width: 100%;
    padding: 13px 14px;
    border: 1px solid #dbe8f5;
    border-radius: 14px;
    background: #fff;
    font-size: 14px;
    color: #1f3b5a;
}
.toolbar-grid button {
    padding: 13px 18px;
    border: none;
    border-radius: 14px;
    background: #003056;
    color: white;
    font-weight: 700;
    cursor: pointer;
    transition: background .2s, transform .2s;
}
.toolbar-grid button:hover {
    background: #002542;
    transform: translateY(-1px);
}
.table-card {
    overflow-x: auto;
    border-radius: 20px;
    border: 1px solid #e2e8f0;
    background: #fff;
}
.table-card table {
    width: 100%;
    min-width: 900px;
    border-collapse: collapse;
}
.table-card th,
.table-card td {
    padding: 16px 14px;
    text-align: left;
    vertical-align: middle;
}
.table-card th {
    background: #eef5fb;
    color: #003056;
    font-size: 12px;
    letter-spacing: .1em;
    text-transform: uppercase;
    border-bottom: 1px solid #e2e8f0;
}
.table-card td {
    border-bottom: 1px solid #f1f5f9;
    color: #475569;
    font-size: 14px;
}
.table-card tbody tr:hover {
    background: #f7fbff;
}
.status-pill {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 12px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
}
.status-pill.review {
    background: #fff4d6;
    color: #7c5a00;
}
.status-pill.accept {
    background: #e6f4ea;
    color: #1f6d27;
}
.status-pill.reject {
    background: #fde8ec;
    color: #8a1d2b;
}
.action-group {
    display: flex;
    justify-content: flex-end;
    flex-wrap: wrap;
    gap: 8px;
}
.action-group a,
.action-group button {
    border-radius: 14px;
    padding: 10px 14px;
    text-decoration: none;
    border: 1px solid transparent;
    font-size: 13px;
    cursor: pointer;
    transition: all .2s;
}
.action-group a.edit {
    background: #eef6ff;
    color: #0f4d8d;
    border-color: #d6e8ff;
}
.action-group button.delete {
    background: #fff1f2;
    color: #ac1b2f;
    border-color: #f6d7dc;
}
.action-group button.delete:hover {
    background: #fde2e5;
}
.no-data {
    padding: 48px 0;
    text-align: center;
    color: #667485;
    font-size: 15px;
}
@media (max-width: 860px) {
    .toolbar-grid {
        grid-template-columns: 1fr;
    }
    .hero-stat {
        padding: 16px;
    }
    .booking-hero {
        padding: 24px 20px;
    }
}
@media (max-width: 560px) {
    .section-title {
        flex-direction: column;
        align-items: stretch;
    }
    .toolbar-grid button {
        width: 100%;
    }
}
</style>

<div class="booking-hero">
    <div class="section-title">
        <div>
            <h1>Manajemen Booking PKL</h1>
            <p>Review dan update status pengajuan PKL siswa dengan tampilan yang lebih segar dan konsisten.</p>
        </div>
        <a href="{{ route('admin.booking.create') }}" class="btn btn-primary" style="border-radius: 999px; padding: 12px 24px; font-weight: 700;">+ Tambah Booking</a>
    </div>
    <div class="hero-stats">
        <div class="hero-stat"><strong>{{ $totalBooking }}</strong><span>Total Booking</span></div>
        <div class="hero-stat"><strong>{{ $bookingDireview }}</strong><span>Direview</span></div>
        <div class="hero-stat"><strong>{{ $bookingDiterima }}</strong><span>Diterima</span></div>
        <div class="hero-stat"><strong>{{ $bookingDitolak }}</strong><span>Ditolak</span></div>
    </div>
</div>

<div class="card" style="padding: 0; overflow: hidden;">
    <div class="toolbar-panel">
        <div>
            <h2>Daftar Booking</h2>
            <p style="margin: 8px 0 0; color:#6b7a91; font-size:14px;">Filter, cari, dan kelola semua pengajuan PKL siswa di satu tempat.</p>
        </div>
        <form action="{{ route('admin.booking.index') }}" method="GET" class="toolbar-grid">
            <input type="text" name="search" placeholder="Cari nama atau NIS siswa..." value="{{ $search }}" />
            <select name="status">
                <option value="">Semua Status</option>
                <option value="Direview" {{ $status == 'Direview' ? 'selected' : '' }}>Direview</option>
                <option value="Diterima" {{ $status == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                <option value="Ditolak" {{ $status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
            <select name="sort_by">
                <option value="newest" {{ $sortBy == 'newest' ? 'selected' : '' }}>Terbaru</option>
                <option value="oldest" {{ $sortBy == 'oldest' ? 'selected' : '' }}>Terlama</option>
                <option value="siswa_asc" {{ $sortBy == 'siswa_asc' ? 'selected' : '' }}>NIS A-Z</option>
                <option value="siswa_desc" {{ $sortBy == 'siswa_desc' ? 'selected' : '' }}>NIS Z-A</option>
            </select>
            <button type="submit">Cari</button>
        </form>
    </div>

    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th style="width:70px;">No</th>
                    <th>Nama Siswa</th>
                    <th>NIS</th>
                    <th>DUDI</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th style="width:180px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $key => $booking)
                    <tr>
                        <td>{{ ($bookings->currentPage() - 1) * $bookings->perPage() + $loop->iteration }}</td>
                        <td><strong>{{ $booking->siswa->nama }}</strong></td>
                        <td>{{ $booking->nis }}</td>
                        <td>{{ $booking->dudi->nama_dudi }}</td>
                        <td>
                            @if($booking->status === 'Diterima')
                                <span class="status-pill accept">✓ Diterima</span>
                            @elseif($booking->status === 'Ditolak')
                                <span class="status-pill reject">✗ Ditolak</span>
                            @else
                                <span class="status-pill review">⏳ Direview</span>
                            @endif
                        </td>
                        <td>{{ $booking->created_at->format('d M Y') }}</td>
                        <td>
                            <div class="action-group">
                                <a href="{{ route('admin.booking.edit', $booking->id_booking) }}" class="edit">Edit</a>
                                <form action="{{ route('admin.booking.destroy', $booking->id_booking) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="no-data">Tidak ada data booking</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($bookings->hasPages())
        <div class="pagination" style="margin: 20px; justify-content: flex-end;">
            @if($bookings->onFirstPage())
                <span>← Sebelumnya</span>
            @else
                <a href="{{ $bookings->previousPageUrl() }}{{ !empty($search) ? '&search='.$search : '' }}{{ !empty($status) ? '&status='.$status : '' }}{{ $sortBy != 'newest' ? '&sort_by='.$sortBy : '' }}">← Sebelumnya</a>
            @endif

            @foreach($bookings->getUrlRange(1, $bookings->lastPage()) as $page => $url)
                @if($page == $bookings->currentPage())
                    <span class="active"><span>{{ $page }}</span></span>
                @else
                    <a href="{{ $url }}{{ !empty($search) ? '&search='.$search : '' }}{{ !empty($status) ? '&status='.$status : '' }}{{ $sortBy != 'newest' ? '&sort_by='.$sortBy : '' }}">{{ $page }}</a>
                @endif
            @endforeach

            @if($bookings->hasMorePages())
                <a href="{{ $bookings->nextPageUrl() }}{{ !empty($search) ? '&search='.$search : '' }}{{ !empty($status) ? '&status='.$status : '' }}{{ $sortBy != 'newest' ? '&sort_by='.$sortBy : '' }}">Selanjutnya →</a>
            @else
                <span>Selanjutnya →</span>
            @endif
        </div>
    @endif
</div>
@endsection
