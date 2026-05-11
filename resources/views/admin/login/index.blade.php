@extends('layouts.app')

@section('title', 'Manajemen Login')

@section('head')
<style>
    .admin-login-header {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .admin-login-header .stats {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .admin-login-card {
        display: grid;
        gap: 1.5rem;
    }

    .admin-login-toolbar {
        display: grid;
        gap: 1rem;
    }

    @media (min-width: 768px) {
        .admin-login-toolbar {
            grid-template-columns: repeat(4, minmax(0, 1fr));
            align-items: end;
        }

        .admin-login-header {
            flex-wrap: nowrap;
        }
    }

    .admin-login-toolbar select,
    .admin-login-toolbar input[type="text"] {
        width: 100%;
        min-width: 0;
    }

    .admin-login-toolbar button {
        min-width: 180px;
    }

    .stats-card {
        background: var(--primary);
        color: white;
        padding: 22px;
        border-radius: 18px;
        min-width: 180px;
        flex: 1;
        box-shadow: 0 14px 34px rgba(0, 48, 86, 0.12);
    }

    .stats-card .stat-label {
        font-size: 0.8rem;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        opacity: 0.7;
        margin-bottom: 0.75rem;
    }

    .stats-card .stat-value {
        font-size: 2rem;
        font-weight: 700;
    }

    .text-sm {
        font-size: 0.9rem;
    }

    .text-gray-500 {
        color: #64748b;
    }

    .badge-role {
        display: inline-flex;
        align-items: center;
        padding: 8px 12px;
        border-radius: 999px;
        font-size: 0.8rem;
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
        gap: 0.5rem;
    }

    .no-data {
        padding: 28px 0;
        text-align: center;
        color: #64748b;
        font-size: 0.95rem;
    }

    .edit,
    .delete {
        padding: 0.65rem 0.85rem;
        border-radius: 12px;
        border: 1px solid transparent;
        font-size: 0.9rem;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .edit {
        background: #eef6ff;
        color: #0f4d8d;
        border-color: #d6e8ff;
    }

    .edit:hover {
        background: #d6e8ff;
    }

    .delete {
        background: #fff1f2;
        color: #ac1b2f;
        border-color: #f6d7dc;
    }

    .delete:hover {
        background: #fde2e5;
    }

    .table-footer {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
        margin-top: 1rem;
        align-items: center;
    }

    .table-footer .pagination {
        margin: 0;
    }
</style>
@endsection

@section('content')
    <div class="page-header">
        <h1>Manajemen Login</h1>
        <p>Kelola akun Admin dan Siswa dengan tampilan yang bersih dan tanpa error.</p>
    </div>

    <div class="card admin-login-card">
        <div class="card-header">
            <h2>Ringkasan Pengguna</h2>
        </div>
        <div class="admin-login-header">
            <div>
                <p class="text-sm text-gray-500">Total akun terdaftar dan filter aktif.</p>
            </div>
            <div class="stats">
                <div class="stats-card">
                    <div class="stat-label">Total User</div>
                    <div class="stat-value">{{ $totalUser ?? 0 }}</div>
                </div>
                <div class="stats-card">
                    <div class="stat-label">Admin</div>
                    <div class="stat-value">{{ $totalAdmin ?? 0 }}</div>
                </div>
                <div class="stats-card">
                    <div class="stat-label">Siswa</div>
                    <div class="stat-value">{{ $totalSiswa ?? 0 }}</div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2>Daftar User</h2>
            </div>
            <div class="form-actions admin-login-toolbar">
                <input type="text" name="search" placeholder="Cari username atau nama..." value="{{ $search ?? '' }}" form="filterForm">
                <select name="role" form="filterForm">
                    <option value="" {{ empty($role) ? 'selected' : '' }}>Semua Role</option>
                    <option value="admin" {{ ($role ?? '') === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="siswa" {{ ($role ?? '') === 'siswa' ? 'selected' : '' }}>Siswa</option>
                </select>
                <select name="sort_by" form="filterForm">
                    <option value="newest" {{ ($sortBy ?? 'newest') === 'newest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="oldest" {{ ($sortBy ?? '') === 'oldest' ? 'selected' : '' }}>Terlama</option>
                    <option value="name_asc" {{ ($sortBy ?? '') === 'name_asc' ? 'selected' : '' }}>Nama A-Z</option>
                    <option value="name_desc" {{ ($sortBy ?? '') === 'name_desc' ? 'selected' : '' }}>Nama Z-A</option>
                </select>
                <button type="submit" class="btn btn-primary" form="filterForm">Terapkan Filter</button>
            </div>

            <form id="filterForm" action="{{ route('admin.login.index') }}" method="GET"></form>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 70px;">No</th>
                            <th>Username</th>
                            <th>Nama</th>
                            <th style="width: 130px;">Role</th>
                            <th style="width: 180px; text-align: right;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
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
                                <td style="text-align: right;">
                                    <div class="action-group" style="justify-content: flex-end;">
                                        <a href="{{ route('admin.login.edit', $user->id) }}" class="edit">Edit</a>
                                        <form action="{{ route('admin.login.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');" style="display:inline-flex; gap:0.5rem; align-items:center;">
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

            <div class="table-footer">
                <div>
                    Menampilkan {{ $users->firstItem() ?? 0 }} - {{ $users->lastItem() ?? 0 }} dari {{ $users->total() ?? 0 }} user
                </div>
                @if($users->hasPages())
                    <div class="pagination">
                        @if($users->onFirstPage())
                            <span>← Sebelumnya</span>
                        @else
                            <a href="{{ $users->previousPageUrl() . (empty($search) ? '' : '&search='.$search) . (empty($role) ? '' : '&role='.$role) . ($sortBy !== 'newest' ? '&sort_by='.$sortBy : '') }}">← Sebelumnya</a>
                        @endif

                        @foreach($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                            @if($page == $users->currentPage())
                                <span class="active"><span>{{ $page }}</span></span>
                            @else
                                <a href="{{ $url . (empty($search) ? '' : '&search='.$search) . (empty($role) ? '' : '&role='.$role) . ($sortBy !== 'newest' ? '&sort_by='.$sortBy : '') }}">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if($users->hasMorePages())
                            <a href="{{ $users->nextPageUrl() . (empty($search) ? '' : '&search='.$search) . (empty($role) ? '' : '&role='.$role) . ($sortBy !== 'newest' ? '&sort_by='.$sortBy : '') }}">Selanjutnya →</a>
                        @else
                            <span>Selanjutnya →</span>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
