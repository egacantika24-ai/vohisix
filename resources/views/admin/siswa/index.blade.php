@extends('layouts.app')

@section('title', 'Data Siswa PKL')

@section('content')
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    body {
        font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;
        background-color: #f0f4f8;
    }
    .bg-primary { background-color: #003056; }
    .text-primary { color: #003056; }
    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: #F1F5F9; border-radius: 10px; }
    ::-webkit-scrollbar-thumb { background: #003056; border-radius: 10px; }
</style>

<div class="min-h-screen bg-[#f0f4f8]">
    <!-- Header -->
    <header class="bg-primary text-white px-8 py-8 shadow-lg">
        <div class="container mx-auto flex flex-col md:flex-row justify-between items-center gap-6">
            <div>
                <h1 class="text-3xl font-bold tracking-tight mb-1">Data Siswa PKL</h1>
                <p class="text-slate-300 text-sm opacity-80">Portal Administrasi Program Praktik Kerja Lapangan Terpadu</p>
            </div>
            <div class="flex gap-8">
                <div class="text-center border-r border-white/20 pr-8">
                    <span class="block text-3xl font-bold text-white">{{ $totalSiswa }}</span>
                    <span class="text-[10px] uppercase tracking-[0.2em] text-slate-300 font-bold">Total Siswa</span>
                </div>
                <div class="text-center">
                    <span class="block text-3xl font-bold text-white">{{ $totalBerkas }}</span>
                    <span class="text-[10px] uppercase tracking-[0.2em] text-slate-300 font-bold">Total Berkas</span>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-slate-200">
            <!-- Toolbar -->
            <div class="bg-slate-50 p-6 border-b border-slate-200 flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </div>
                        <input type="text" placeholder="Cari NIS atau Nama..." class="pl-10 pr-4 py-2.5 border border-slate-300 rounded-lg text-sm w-full md:w-80 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all bg-white" value="{{ $search ?? '' }}" name="search">
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400">
                                <polygon points="22 3 2 3 10 13 10 21 14 18 14 13 22 3"></polygon>
                            </svg>
                        </div>
                        <select class="bg-white border border-slate-300 rounded-lg text-sm pl-10 pr-8 py-2.5 outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all appearance-none cursor-pointer w-full" name="kelas">
                            <option value="">Semua Kelas</option>
                            @foreach($allKelas as $k)
                                <option value="{{ $k }}" {{ ($kelas == $k) ? 'selected' : '' }}>{{ $k }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <a href="{{ route('admin.siswa.create') }}" class="bg-primary hover:bg-[#002542] text-white px-8 py-2.5 rounded-lg text-sm font-bold transition shadow-md flex items-center gap-2 w-full md:w-auto justify-center">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Tambah Siswa Baru
                </a>
            </div>

        <div class="mt-8 text-center pb-12">
            <p class="text-slate-400 text-[9px] uppercase tracking-[0.3em] font-black">Sistem Informasi PKL Terpadu © 2026 • Professional Edition</p>
        </div>
    </main>
</div>
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
.doc-pill-group {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}
.doc-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 12px;
    border-radius: 999px;
    background: #f1f5f9;
    color: #475569;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
}
.doc-pill.uploaded {
    background: #dbeafe;
    color: #1e40af;
    border: 1px solid #bfdbfe;
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

    <div class="toolbar-panel" style="margin-bottom: 20px;">
        <div>
            <h2>Impor Data Siswa</h2>
            <p style="margin: 8px 0 0; color:#6b7a91; font-size:14px;">Unggah file Excel / CSV untuk menambahkan banyak siswa sekaligus.</p>
        </div>
        <form action="{{ route('admin.siswa.import') }}" method="POST" enctype="multipart/form-data" class="toolbar-grid">
            @csrf
            <input type="file" name="file" accept=".csv,.xlsx" required />
            <button type="submit">Unggah Excel</button>
        </form>
    </div>

    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th style="width:70px;">No</th>
                    <th style="width:100px;">Foto</th>
                    <th>Nama</th>
                    <th>NIS</th>
                    <th>Kelas</th>
                    <th>Verifikasi Berkas</th>
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
                        <td><strong>{{ $siswa->nama }}</strong></td>
                        <td>{{ $siswa->nis }}</td>
                        <td>{{ $siswa->kelas }}</td>
                        <td>
                            <div class="doc-pill-group">
                                <span class="doc-pill {{ $siswa->berkas && $siswa->berkas->ktp_kia ? 'uploaded' : '' }}">KTP/KIA</span>
                                <span class="doc-pill {{ $siswa->berkas && $siswa->berkas->surat_sehat ? 'uploaded' : '' }}">SEHAT</span>
                                <span class="doc-pill {{ $siswa->berkas && $siswa->berkas->kartu_bpjs ? 'uploaded' : '' }}">BPJS</span>
                            </div>
                        </td>
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
                        <td colspan="7" class="no-data">Tidak ada data siswa</td>
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
