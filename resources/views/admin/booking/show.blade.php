@extends('layouts.app')

@section('title', 'Detail Booking')

@section('content')
<div class="page-header">
    <h1>Detail Booking PKL</h1>
</div>

<div class="card" style="max-width: 600px;">
    <div class="card-header">
        <h2>{{ $booking->siswa->nama }} - {{ $booking->dudi->nama_dudi }}</h2>
    </div>

    <div style="margin-bottom: 20px;">
        <p><strong>Nama Siswa:</strong> {{ $booking->siswa->nama }}</p>
        <p><strong>NIS:</strong> {{ $booking->nis }}</p>
        <p><strong>Kelas:</strong> {{ $booking->siswa->kelas }}</p>
        <p><strong>DUDI:</strong> {{ $booking->dudi->nama_dudi }}</p>
        <p><strong>Bidang Usaha:</strong> {{ $booking->dudi->bidang_usaha }}</p>
        <p>
            <strong>Status:</strong> 
            @if($booking->status === 'Diterima')
                <span style="background: #d4edda; color: #155724; padding: 4px 8px; border-radius: 3px;">✓ Diterima</span>
            @elseif($booking->status === 'Ditolak')
                <span style="background: #f8d7da; color: #721c24; padding: 4px 8px; border-radius: 3px;">✗ Ditolak</span>
            @else
                <span style="background: #fff3cd; color: #856404; padding: 4px 8px; border-radius: 3px;">⏳ Direview</span>
            @endif
        </p>
        <p><strong>Tanggal Pengajuan:</strong> {{ $booking->created_at->format('d M Y H:i') }}</p>
    </div>

    <div style="display: flex; gap: 10px;">
        <a href="{{ route('admin.booking.edit', $booking->id_booking) }}" class="btn btn-primary">Edit Status</a>
        <a href="{{ route('admin.booking.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection
