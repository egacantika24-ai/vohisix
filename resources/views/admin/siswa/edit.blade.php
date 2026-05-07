@extends('layouts.app')

@section('title', 'Edit Siswa')

@section('content')
<div class="page-header">
    <h1>Edit Data Siswa</h1>
    <p class="form-helper">Perbarui data siswa agar profil dan login tetap sinkron.</p>
</div>

<div class="form-card" style="max-width: 700px; margin: 0 auto;">
    <div class="card-header">
        <h2>{{ $siswa->nama }}</h2>
        <p class="form-helper">Ubah NIS, nama, kelas, atau foto siswa.</p>
    </div>

    <form action="{{ route('admin.siswa.update', $siswa->nis) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nis">NIS / Username Login *</label>
            <input type="text" id="nis" name="nis" value="{{ old('nis', $siswa->nis) }}" required>
            <span class="form-helper">Jika NIS diubah, username dan password siswa akan disesuaikan dengan NIS baru.</span>
            @error('nis')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="nama">Nama Lengkap *</label>
            <input type="text" id="nama" name="nama" value="{{ old('nama', $siswa->nama) }}" required>
            @error('nama')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Kelas *</label>
            <div class="form-row" style="gap: 16px;">
                <label class="radio-option"><input type="radio" name="kelas" value="XIII SIJA 1" {{ old('kelas', $siswa->kelas) == 'XIII SIJA 1' ? 'checked' : '' }}> XIII SIJA 1</label>
                <label class="radio-option"><input type="radio" name="kelas" value="XIII SIJA 2" {{ old('kelas', $siswa->kelas) == 'XIII SIJA 2' ? 'checked' : '' }}> XIII SIJA 2</label>
            </div>
            @error('kelas')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="foto">Foto Siswa (opsional)</label>
            <input type="file" id="foto" name="foto" accept="image/*">
            @if($siswa->foto)
                <div style="margin-top: 10px;">
                    <img src="{{ asset('storage/'.$siswa->foto) }}" alt="Foto" style="width:100px;height:100px;object-fit:cover;border-radius:14px;border:1px solid rgba(0,0,0,0.08);">
                </div>
            @endif
            @error('foto')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
