@extends('layouts.app')

@section('title', 'Tambah Siswa')

@section('content')
<div class="page-header">
    <h1>Tambah Siswa Baru</h1>
    <p class="form-helper">Tambahkan siswa baru dengan data lengkap untuk login dan booking PKL.</p>
</div>

<div class="form-card" style="max-width: 700px; margin: 0 auto;">
    <div class="card-header">
        <h2>Form Pendaftaran Siswa</h2>
        <p class="form-helper">Masukkan NIS, nama, kelas, dan unggah foto jika tersedia.</p>
    </div>

    <form action="{{ route('admin.siswa.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="nis">NIS *</label>
            <input type="text" id="nis" name="nis" value="{{ old('nis') }}" required>
            @error('nis')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="nama">Nama Lengkap *</label>
            <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required>
            @error('nama')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Kelas *</label>
            <div class="form-row" style="gap: 16px;">
                <label class="radio-option"><input type="radio" name="kelas" value="XIII SIJA 1" {{ old('kelas') == 'XIII SIJA 1' ? 'checked' : '' }}> XIII SIJA 1</label>
                <label class="radio-option"><input type="radio" name="kelas" value="XIII SIJA 2" {{ old('kelas') == 'XIII SIJA 2' ? 'checked' : '' }}> XIII SIJA 2</label>
            </div>
            @error('kelas')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="foto">Foto Siswa (opsional)</label>
            <input type="file" id="foto" name="foto" accept="image/*">
            @error('foto')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Simpan Siswa</button>
            <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
