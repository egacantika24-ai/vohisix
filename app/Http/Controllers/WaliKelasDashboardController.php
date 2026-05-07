<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Booking;

class WaliKelasDashboardController extends Controller
{
    /**
     * Show wali kelas dashboard
     */
    public function index()
    {
        $user = auth()->user();
        $kelas = $user->kelas_id;

        $totalSiswa = Siswa::where('kelas', $kelas)->count();
        $totalBooking = Booking::whereHas('siswa', function($query) use ($kelas) {
            $query->where('kelas', $kelas);
        })->count();
        
        $bookingDireview = Booking::whereHas('siswa', function($query) use ($kelas) {
            $query->where('kelas', $kelas);
        })->where('status', 'Direview')->count();
        
        $bookingDiterima = Booking::whereHas('siswa', function($query) use ($kelas) {
            $query->where('kelas', $kelas);
        })->where('status', 'Diterima')->count();
        
        $bookingDitolak = Booking::whereHas('siswa', function($query) use ($kelas) {
            $query->where('kelas', $kelas);
        })->where('status', 'Ditolak')->count();

        return view('wali-kelas.dashboard', compact(
            'kelas',
            'totalSiswa',
            'totalBooking',
            'bookingDireview',
            'bookingDiterima',
            'bookingDitolak'
        ));
    }

    /**
     * Show siswa list for wali_kelas
     */
    public function siswas()
    {
        $user = auth()->user();
        $kelas = $user->kelas_id;
        $siswas = Siswa::where('kelas', $kelas)->paginate(15);

        return view('wali-kelas.siswas', compact('siswas', 'kelas'));
    }

    /**
     * Show bookings for wali_kelas
     */
    public function bookings()
    {
        $user = auth()->user();
        $kelas = $user->kelas_id;
        $bookings = Booking::whereHas('siswa', function($query) use ($kelas) {
            $query->where('kelas', $kelas);
        })->with('siswa')->paginate(15);

        return view('wali-kelas.bookings', compact('bookings', 'kelas'));
    }
}
