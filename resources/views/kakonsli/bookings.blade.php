@extends('layouts.app')

@section('title', 'Daftar Booking Kedua Kelas')

@section('content')
<div class="page-header">
    <h1>Daftar Booking</h1>
    <p>Data booking dari kedua kelas: <strong>{{ $kelas1 }}</strong> dan <strong>{{ $kelas2 }}</strong></p>
</div>

<div class="card">
    <div class="card-header">
        <h2>Data Booking Kedua Kelas</h2>
    </div>
    
    @if($bookings->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Status</th>
                    <th>Tanggal Booking</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->siswa->nis }}</td>
                        <td>{{ $booking->siswa->nama }}</td>
                        <td>
                            <span class="badge" style="background-color: {{ $booking->siswa->kelas === $kelas1 ? '#007bff' : '#17a2b8' }};">
                                {{ $booking->siswa->kelas }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-{{ $booking->status === 'Diterima' ? 'success' : ($booking->status === 'Ditolak' ? 'danger' : 'warning') }}">
                                {{ $booking->status }}
                            </span>
                        </td>
                        <td>{{ $booking->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-info">Lihat</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <div style="margin-top: 20px;">
            {{ $bookings->links() }}
        </div>
    @else
        <div style="padding: 20px; text-align: center; color: #666;">
            <p>Tidak ada booking untuk kedua kelas ini</p>
        </div>
    @endif
</div>

<div style="margin-top: 20px;">
    <a href="{{ route('kakonsli.dashboard') }}" class="btn btn-secondary">← Kembali ke Dashboard</a>
</div>
@endsection
