@extends('layouts.app')

@section('title', 'Dashboard Kakonsli')

@section('content')
<div class="page-header">
    <h1>Dashboard Kakonsli (Ketua Konsentrasi Keahlian)</h1>
    <p>Anda dapat melihat data kedua kelas: <strong>{{ $kelas1 }}</strong> dan <strong>{{ $kelas2 }}</strong></p>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-label">Total Siswa (Kedua Kelas)</div>
        <div class="stat-number">{{ $totalSiswa }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Total Booking (Kedua Kelas)</div>
        <div class="stat-number">{{ $totalBooking }}</div>
    </div>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
    <div class="card" style="border-left: 4px solid #ffc107;">
        <div class="stat-label">Booking Direview</div>
        <div class="stat-number" style="color: #ffc107;">{{ $bookingDireview }}</div>
    </div>
    <div class="card" style="border-left: 4px solid #28a745;">
        <div class="stat-label">Booking Diterima</div>
        <div class="stat-number" style="color: #28a745;">{{ $bookingDiterima }}</div>
    </div>
    <div class="card" style="border-left: 4px solid #dc3545;">
        <div class="stat-label">Booking Ditolak</div>
        <div class="stat-number" style="color: #dc3545;">{{ $bookingDitolak }}</div>
    </div>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-top: 20px;">
    <div class="card" style="border-top: 3px solid #007bff;">
        <div class="stat-label" style="color: #007bff;">Kelas 1</div>
        <div class="stat-number" style="color: #007bff;">{{ $kelas1 }}</div>
    </div>
    <div class="card" style="border-top: 3px solid #17a2b8;">
        <div class="stat-label" style="color: #17a2b8;">Kelas 2</div>
        <div class="stat-number" style="color: #17a2b8;">{{ $kelas2 }}</div>
    </div>
</div>

<div class="card" style="margin-top: 30px;">
    <div class="card-header">
        <h2>Menu Utama</h2>
    </div>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 15px;">
        <a href="{{ route('kakonsli.siswas') }}" class="btn btn-primary" style="text-align: center;">👥 Lihat Siswa</a>
        <a href="{{ route('kakonsli.bookings') }}" class="btn btn-primary" style="text-align: center;">📋 Lihat Booking</a>
    </div>
</div>
@endsection
