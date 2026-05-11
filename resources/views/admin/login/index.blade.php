@extends('layouts.app')

@section('title', 'Manajemen Login')

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
                <h1 class="text-3xl font-bold tracking-tight mb-1">Manajemen Login</h1>
                <p class="text-slate-300 text-sm opacity-80">Kelola akun user (Admin & Siswa) untuk akses sistem PKL</p>
            </div>
            <div class="flex gap-8">
                <div class="text-center border-r border-white/20 pr-8">
                    <span class="block text-3xl font-bold text-white">{{ $totalUser }}</span>
                    <span class="text-[10px] uppercase tracking-[0.2em] text-slate-300 font-bold">Total User</span>
                </div>
                <div class="text-center border-r border-white/20 pr-8">
                    <span class="block text-3xl font-bold text-white">{{ $totalAdmin }}</span>
                    <span class="text-[10px] uppercase tracking-[0.2em] text-slate-300 font-bold">Admin</span>
                </div>
                <div class="text-center">
                    <span class="block text-3xl font-bold text-white">{{ $totalSiswa }}</span>
                    <span class="text-[10px] uppercase tracking-[0.2em] text-slate-300 font-bold">Siswa</span>
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
                        <input type="text" placeholder="Cari username atau nama..." class="pl-10 pr-4 py-2.5 border border-slate-300 rounded-lg text-sm w-full md:w-80 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all bg-white" value="{{ $search ?? '' }}" name="search">
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400">
                                <polygon points="22 3 2 3 10 13 10 21 14 18 14 13 22 3"></polygon>
                            </svg>
                        </div>
                        <select class="bg-white border border-slate-300 rounded-lg text-sm pl-10 pr-8 py-2.5 outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all appearance-none cursor-pointer w-full" name="role">
                            <option value="">Semua Role</option>
                            <option value="admin" {{ ($roleFilter == 'admin') ? 'selected' : '' }}>Admin</option>
                            <option value="siswa" {{ ($roleFilter == 'siswa') ? 'selected' : '' }}>Siswa</option>
                        </select>
                    </div>
                </div>
                <a href="{{ route('admin.login.create') ?? '#' }}" class="bg-primary hover:bg-[#002542] text-white px-8 py-2.5 rounded-lg text-sm font-bold transition shadow-md flex items-center gap-2 w-full md:w-auto justify-center">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Tambah User Baru
                </a>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-primary/5 text-primary text-[11px] uppercase font-bold tracking-widest border-b border-slate-200">
                            <th class="px-6 py-5 w-16 text-center">No</th>
                            <th class="px-6 py-5">Username</th>
                            <th class="px-6 py-5">Nama Lengkap</th>
                            <th class="px-6 py-5 w-32 text-center">Role</th>
                            <th class="px-6 py-5 text-right w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($users ?? [] as $user)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-6 py-4 text-center text-slate-400 font-mono text-xs">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-primary text-sm">{{ $user->username ?? $user->email }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-slate-700 text-sm">{{ $user->name }}</div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($user->role === 'admin')
                                        <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-[10px] font-bold uppercase tracking-wider">Admin</span>
                                    @else
                                        <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-[10px] font-bold uppercase tracking-wider">Siswa</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-1">
                                        <a href="" class="text-primary hover:text-primary/70 p-1.5 hover:bg-primary/5 rounded-lg transition-all" title="Edit">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M17 3l4 4L7 21H3v-4L17 3z"></path>
                                            </svg>
                                        </a>
                                        <form action="" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 p-1.5 hover:bg-red-50 rounded-lg transition-all" title="Hapus" onclick="return confirm('Yakin ingin menghapus?')">
                                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M3 6h18"></path>
                                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-20 text-center text-slate-300">
                                    <div class="flex flex-col items-center gap-3">
                                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="opacity-10">
                                            <circle cx="11" cy="11" r="8"></circle>
                                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                        </svg>
                                        <p class="font-bold text-xs uppercase tracking-widest">Data Tidak Ditemukan</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Footer -->
            <div class="bg-primary text-white/70 px-8 py-5 flex flex-col md:flex-row justify-between items-center gap-4 text-[10px] uppercase font-bold tracking-[0.2em]">
                <div class="flex items-center gap-3">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white/50">
                        <ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
                        <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>
                        <path d="M3 12c0 1.66 4 3 9 3s9-1.34 9-3"></path>
                    </svg>
                    <span>Total user terdaftar: <span class="text-white font-black">{{ $totalUser ?? 0 }}</span> akun</span>
                </div>
                <div class="flex items-center gap-3">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white/50">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    <span>Terakhir diperbarui: <span class="text-white font-medium">{{ now()->format('d F Y, H:i') }}</span></span>
                </div>
            </div>
        </div>

        <div class="mt-8 text-center pb-12">
            <p class="text-slate-400 text-[9px] uppercase tracking-[0.3em] font-black">Sistem Informasi PKL Terpadu © 2026 • Professional Edition</p>
        </div>
    </main>
</div>
}
.table-card table {
    width: 100%;
    min-width: 780px;
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
.badge-role {
    display: inline-flex;
    align-items: center;
    padding: 8px 12px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
}
.badge-role.admin {
    background: #ede9ff;
    color: #372c7a;
}
.badge-role.siswa {
    background: #def2ff;
    color: #125e8a;
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
    .toolbar-grid { grid-template-columns: 1fr; }
    .page-hero { padding: 24px 20px; }
}
@media (max-width: 560px) {
    .section-title { flex-direction: column; align-items: stretch; }
    .toolbar-grid button { width: 100%; }
}
</style>

<div class="page-hero">
    <div class="section-title">
        <div>
            <h1>Manajemen Login</h1>
            <p>Kelola akun user Admin dan Siswa dengan tampilan yang rapi dan modern.</p>
        </div>
        <a href="{{ route('admin.login.create') }}" class="btn btn-primary" style="border-radius: 999px; padding: 12px 24px; font-weight: 700;">+ Tambah User</a>
    </div>
    <div class="hero-stats">
        <div class="hero-stat"><strong>{{ $totalUser }}</strong><span>Total User</span></div>
        <div class="hero-stat"><strong>{{ $totalAdmin }}</strong><span>Admin</span></div>
        <div class="hero-stat"><strong>{{ $totalSiswa }}</strong><span>Siswa</span></div>
    </div>
</div>

<div class="card" style="padding: 0; overflow: hidden;">
    <div class="toolbar-panel">
        <div>
            <h2>Daftar User</h2>
            <p style="margin: 8px 0 0; color:#6b7a91; font-size:14px;">Cari dan filter akun siswa maupun admin dengan antarmuka yang lebih bersih.</p>
        </div>
        <form action="{{ route('admin.login.index') }}" method="GET" class="toolbar-grid">
            <input type="text" name="search" placeholder="Cari username atau nama..." value="{{ $search }}" />
            <select name="role">
                <option value="">Semua Role</option>
                <option value="admin" {{ $role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="siswa" {{ $role == 'siswa' ? 'selected' : '' }}>Siswa</option>
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
            <h2>Impor Data User</h2>
            <p style="margin: 8px 0 0; color:#6b7a91; font-size:14px;">Unggah file Excel / CSV untuk membuat akun pengguna Admin dan Siswa secara masal.</p>
        </div>
        <form action="{{ route('admin.login.import') }}" method="POST" enctype="multipart/form-data" class="toolbar-grid">
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
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Role</th>
                    <th style="width:180px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $key => $user)
                    <tr>
                        <td>{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                        <td><strong>{{ $user->username }}</strong></td>
                        <td>{{ $user->name }}</td>
                        <td>
                            @if($user->role === 'admin')
                                <span class="badge-role admin">Admin</span>
                            @else
                                <span class="badge-role siswa">Siswa</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-group">
                                <a href="{{ route('admin.login.edit', $user->id) }}" class="edit">Edit</a>
                                <form action="{{ route('admin.login.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="no-data">Tidak ada data user</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($users->hasPages())
        <div class="pagination" style="margin: 20px; justify-content: flex-end;">
            @if($users->onFirstPage())
                <span>← Sebelumnya</span>
            @else
                <a href="{{ $users->previousPageUrl() }}{{ !empty($search) ? '&search='.$search : '' }}{{ !empty($role) ? '&role='.$role : '' }}{{ $sortBy != 'newest' ? '&sort_by='.$sortBy : '' }}">← Sebelumnya</a>
            @endif

            @foreach($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                @if($page == $users->currentPage())
                    <span class="active"><span>{{ $page }}</span></span>
                @else
                    <a href="{{ $url }}{{ !empty($search) ? '&search='.$search : '' }}{{ !empty($role) ? '&role='.$role : '' }}{{ $sortBy != 'newest' ? '&sort_by='.$sortBy : '' }}">{{ $page }}</a>
                @endif
            @endforeach

            @if($users->hasMorePages())
                <a href="{{ $users->nextPageUrl() }}{{ !empty($search) ? '&search='.$search : '' }}{{ !empty($role) ? '&role='.$role : '' }}{{ $sortBy != 'newest' ? '&sort_by='.$sortBy : '' }}">Selanjutnya →</a>
            @else
                <span>Selanjutnya →</span>
            @endif
        </div>
    @endif
</div>
@endsection
