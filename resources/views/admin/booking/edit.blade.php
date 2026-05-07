@extends('layouts.app')

@section('title', 'Edit Status Booking')

@section('content')
<div class="page-header">
    <h1>Update Status Booking PKL</h1>
    <p class="form-helper">Ubah status pengajuan PKL untuk siswa yang sedang direview.</p>
</div>

<div class="form-card" style="max-width: 700px; margin: 0 auto;">
    <div class="card-header">
        <h2>Booking {{ $booking->siswa->nama }}</h2>
        <p class="form-helper">Pastikan status booking sudah sesuai sebelum menyimpan.</p>
    </div>

    <div class="form-group" style="padding: 0; margin-bottom: 24px;">
        <div style="display: grid; gap: 10px;">
            <p><strong>Nama Siswa:</strong> {{ $booking->siswa->nama }}</p>
            <p><strong>NIS:</strong> {{ $booking->nis }}</p>
            <p><strong>Kelas:</strong> {{ $booking->siswa->kelas }}</p>
            <p><strong>DUDI:</strong> {{ $booking->dudi->nama_dudi }}</p>
            <p><strong>Tanggal Pengajuan:</strong> {{ $booking->created_at->format('d M Y H:i') }}</p>
        </div>
    </div>

    <form action="{{ route('admin.booking.update', $booking->id_booking) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="status">Status Booking *</label>
            <select id="status" name="status" required>
                <option value="">Pilih Status</option>
                <option value="Direview" @if($booking->status === 'Direview') selected @endif>Direview</option>
                <option value="Diterima" @if($booking->status === 'Diterima') selected @endif>Diterima</option>
                <option value="Ditolak" @if($booking->status === 'Ditolak') selected @endif>Ditolak</option>
            </select>
            @error('status')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Simpan Status</button>
            <a href="{{ route('admin.booking.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection
