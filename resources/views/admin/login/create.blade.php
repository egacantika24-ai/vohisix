@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
<div class="page-header">
    <h1>Tambah User Baru</h1>
    <p class="form-helper">Buat akun baru untuk administrator atau siswa dengan hak akses sesuai.</p>
</div>

<div class="form-card" style="max-width: 700px; margin: 0 auto;">
    <div class="card-header">
        <h2>Form Pendaftaran User</h2>
        <p class="form-helper">Gunakan username unik dan password aman untuk setiap akun.</p>
    </div>

    <form action="{{ route('admin.login.store') }}" method="POST">
        @csrf

        <div class="form-row">
            <div class="form-group">
                <label for="username">Username *</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" required>
                @error('username')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">Nama *</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="role">Role *</label>
                <select id="role" name="role" required>
                    <option value="">Pilih Role</option>
                    <option value="admin">Admin</option>
                    <option value="siswa">Siswa</option>
                </select>
                @error('role')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password *</label>
                <input type="password" id="password" name="password" required>
                @error('password')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Simpan User</button>
            <a href="{{ route('admin.login.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
