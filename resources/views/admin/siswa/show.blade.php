@extends('layouts.app')

@section('title', 'Detail Siswa')

@section('content')
<div class="page-header">
    <h1>Detail Siswa PKL</h1>
</div>

<div class="card" style="max-width: 600px;">
    <div class="card-header">
        <h2>{{ $siswa->nama }}</h2>
    </div>

    <div style="margin-bottom: 20px;">
        <p><strong>Nama:</strong> {{ $siswa->nama }}</p>
        <p><strong>NIS:</strong> {{ $siswa->nis }}</p>
        <p><strong>Kelas:</strong> {{ $siswa->kelas }}</p>
        <p><strong>Dibuat:</strong> {{ $siswa->created_at->format('d M Y H:i') }}</p>
    </div>

    <div style="display: flex; gap: 10px;">
        <a href="{{ route('admin.siswa.edit', $siswa->nis) }}" class="btn btn-primary">Edit</a>
        <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection
