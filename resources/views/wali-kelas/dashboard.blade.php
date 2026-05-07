@extends('layouts.app')

@section('title', 'Dashboard Wali Kelas')

@section('content')
<div class="page-header">
    <h1>Dashboard Wali Kelas</h1>
    <p>Kelas: <strong>{{ $kelas }}</strong></p>
    <p>Selamat datang di halaman Wali Kelas - Anda dapat melihat data kelas {{ $kelas }}</p>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-label">Total Siswa</div>
        <div class="stat-number">{{ $totalSiswa }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Total Booking</div>
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

<div class="card" style="margin-top: 30px;">
    <div class="card-header">
        <h2>Menu Utama</h2>
    </div>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 15px;">
        <a href="{{ route('wali-kelas.siswas') }}" class="btn btn-primary" style="text-align: center;">👥 Lihat Siswa</a>
        <a href="{{ route('wali-kelas.bookings') }}" class="btn btn-primary" style="text-align: center;">📋 Lihat Booking</a>
    </div>
</div>
@endsection
