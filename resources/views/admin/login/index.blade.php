@extends('layouts.app')

@section('title', 'Manajemen Login')

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
    grid-template-columns: 1fr minmax(160px,200px) minmax(160px,200px) minmax(140px,180px);
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
