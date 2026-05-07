@extends('layouts.app')

@section('title', 'Data Siswa PKL')

@section('content')
<style>
.page-hero {
    background: linear-gradient(135deg, #003056 0%, #0b416a 100%);
    border-radius: 24px;
    color: #fff;
    padding: 32px 28px;
    margin-bottom: 32px;
}
.page-hero h1 {
    margin-bottom: 8px;
    font-size: 2.25rem;
    line-height: 1.05;
}
.page-hero p {
    margin-bottom: 24px;
    color: rgba(255,255,255,.88);
    max-width: 700px;
}
.page-hero .hero-stats {
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
    margin-bottom: 6px;
}
.hero-stat span {
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: .2em;
    color: rgba(255,255,255,.82);
}
.modal-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,.45);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
}
.modal-card {
    background: #fff;
    border-radius: 20px;
    padding: 28px;
    width: min(520px, calc(100% - 40px));
    box-shadow: 0 20px 50px rgba(15, 74, 86, .18);
}
.modal-card h2 {
    margin-bottom: 20px;
    color: #003056;
    font-size: 1.6rem;
}
.modal-card p {
    color: #475569;
    line-height: 1.6;
}
.modal-card .credential-box {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 16px;
    border-left: 4px solid #28a745;
    margin-bottom: 20px;
}
.modal-card .credential-box strong {
    display: block;
    margin-bottom: 8px;
}
.modal-card .credential-value {
    background: #fff;
    padding: 10px;
    border-radius: 12px;
    border: 1px solid #d5d8df;
    font-family: monospace;
    color: #1f3b5a;
    word-break: break-word;
}
.modal-card .btn-close {
    display: inline-block;
    background: #003056;
    color: white;
    border: none;
    padding: 12px 22px;
    border-radius: 14px;
    font-weight: 700;
    cursor: pointer;
    transition: background .2s, transform .2s;
}
.modal-card .btn-close:hover {
    background: #002542;
    transform: translateY(-1px);
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
    min-width: 860px;
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
.avatar-cell img,
.avatar-cell .avatar-placeholder {
    width: 60px;
    height: 60px;
    border-radius: 18px;
    object-fit: cover;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    color: #64748b;
    background: #e7eef7;
}
.no-data {
    padding: 48px 0;
    text-align: center;
    color: #667485;
    font-size: 15px;
}
@media (max-width: 860px) {
    .toolbar-grid { grid-template-columns: 1fr; }
    .page-hero { padding: 24px 20px; }
}
@media (max-width: 560px) {
    .section-title { flex-direction: column; align-items: stretch; }
    .toolbar-grid button { width: 100%; }
}
</style>

@if(session('siswa_created'))
    <div id="credentialsModal" class="modal-backdrop">
        <div class="modal-card">
            <h2>✅ Siswa Berhasil Ditambahkan</h2>
            <div class="credential-box">
                <strong>Nama Siswa:</strong>
                <p>{{ session('siswa_created')['nama'] }}</p>
                <hr style="border:none;border-top:1px solid #e2e8f0;margin:16px 0;">
                <p style="margin: 10px 0 6px 0; font-weight:700; color:#003056;">Username untuk Login:</p>
                <div class="credential-value">{{ session('siswa_created')['username'] }}</div>
                <p style="margin: 16px 0 6px 0; font-weight:700; color:#003056;">Password untuk Login:</p>
                <div class="credential-value">{{ session('siswa_created')['password'] }}</div>
            </div>
            <div style="background:#fff4d6; padding:16px; border-radius:14px; border:1px solid #fde8a7; margin-bottom:20px; color:#7c5a00;">
                <strong>💡 Catatan:</strong> Simpan kredensial di atas untuk diberikan kepada siswa. Siswa dapat langsung login dengan username dan password tersebut.
            </div>
            <button type="button" onclick="closeModal()" class="btn-close">Tutup & Lanjutkan</button>
        </div>
    </div>
    <script>
        function closeModal() {
            document.getElementById('credentialsModal').style.display = 'none';
        }
    </script>
@endif

<div class="page-hero">
    <div class="section-title">
        <div>
            <h1>Data Siswa PKL</h1>
            <p>Kelola data siswa dan berkas PKL dengan tata letak yang lebih mudah dibaca.</p>
        </div>
        <a href="{{ route('admin.siswa.create') }}" class="btn btn-primary" style="border-radius: 999px; padding: 12px 24px; font-weight: 700;">+ Tambah Siswa</a>
    </div>
    <div class="hero-stats">
        <div class="hero-stat"><strong>{{ $totalSiswa }}</strong><span>Total Siswa</span></div>
        <div class="hero-stat"><strong>{{ $totalBerkas }}</strong><span>Total Berkas</span></div>
        <div class="hero-stat"><strong>{{ $totalBooking }}</strong><span>Total Booking</span></div>
    </div>
</div>

<div class="card" style="padding: 0; overflow: hidden;">
    <div class="toolbar-panel">
        <div>
            <h2>Daftar Siswa</h2>
            <p style="margin: 8px 0 0; color:#6b7a91; font-size:14px;">Temukan siswa dengan cepat dan kelola datanya dalam satu tampilan.</p>
        </div>
        <form action="{{ route('admin.siswa.index') }}" method="GET" class="toolbar-grid">
            <input type="text" name="search" placeholder="Cari nama atau NIS..." value="{{ $search }}" />
            <select name="kelas">
                <option value="">Semua Kelas</option>
                @foreach($allKelas as $kelasItem)
                    <option value="{{ $kelasItem }}" {{ $kelas == $kelasItem ? 'selected' : '' }}>{{ $kelasItem }}</option>
                @endforeach
            </select>
            <select name="sort_by">
                <option value="newest" {{ $sortBy == 'newest' ? 'selected' : '' }}>Terbaru</option>
                <option value="oldest" {{ $sortBy == 'oldest' ? 'selected' : '' }}>Terlama</option>
                <option value="name_asc" {{ $sortBy == 'name_asc' ? 'selected' : '' }}>Nama A-Z</option>
                <option value="name_desc" {{ $sortBy == 'name_desc' ? 'selected' : '' }}>Nama Z-A</option>
            </select>
            <button type="submit">Cari</button>
        </form>
    </div>

    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th style="width:70px;">No</th>
                    <th style="width:100px;">Foto</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th style="width:180px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($siswas as $key => $siswa)
                    <tr>
                        <td>{{ ($siswas->currentPage() - 1) * $siswas->perPage() + $loop->iteration }}</td>
                        <td class="avatar-cell">
                            @if($siswa->foto)
                                <img src="{{ asset('storage/'.$siswa->foto) }}" alt="Foto {{ $siswa->nama }}" style="width: 60px; height: 60px; border-radius: 18px; object-fit: cover;" />
                            @else
                                <div class="avatar-placeholder">No Image</div>
                            @endif
                        </td>
                        <td>{{ $siswa->nis }}</td>
                        <td><strong>{{ $siswa->nama }}</strong></td>
                        <td>{{ $siswa->kelas }}</td>
                        <td>
                            <div class="action-group">
                                <a href="{{ route('admin.siswa.edit', $siswa->nis) }}" class="edit">Edit</a>
                                <form action="{{ route('admin.siswa.destroy', $siswa->nis) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="no-data">Tidak ada data siswa</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($siswas->hasPages())
        <div class="pagination" style="margin: 20px; justify-content: flex-end;">
            @if($siswas->onFirstPage())
                <span>← Sebelumnya</span>
            @else
                <a href="{{ $siswas->previousPageUrl() }}{{ !empty($search) ? '&search='.$search : '' }}{{ !empty($kelas) ? '&kelas='.$kelas : '' }}{{ $sortBy != 'newest' ? '&sort_by='.$sortBy : '' }}">← Sebelumnya</a>
            @endif

            @foreach($siswas->getUrlRange(1, $siswas->lastPage()) as $page => $url)
                @if($page == $siswas->currentPage())
                    <span class="active"><span>{{ $page }}</span></span>
                @else
                    <a href="{{ $url }}{{ !empty($search) ? '&search='.$search : '' }}{{ !empty($kelas) ? '&kelas='.$kelas : '' }}{{ $sortBy != 'newest' ? '&sort_by='.$sortBy : '' }}">{{ $page }}</a>
                @endif
            @endforeach

            @if($siswas->hasMorePages())
                <a href="{{ $siswas->nextPageUrl() }}{{ !empty($search) ? '&search='.$search : '' }}{{ !empty($kelas) ? '&kelas='.$kelas : '' }}{{ $sortBy != 'newest' ? '&sort_by='.$sortBy : '' }}">Selanjutnya →</a>
            @else
                <span>Selanjutnya →</span>
            @endif
        </div>
    @endif
</div>
@endsection
