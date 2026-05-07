<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Booking;

class KakonslDashboardController extends Controller
{
    /**
     * Show kakonsli dashboard - can see data from both classes
     */
    public function index()
    {
        $user = auth()->user();
        $kelas1 = $user->kelas_id;
        $kelas2 = $user->kelas_second;

        $totalSiswa = Siswa::whereIn('kelas', [$kelas1, $kelas2])->count();
        $totalBooking = Booking::whereHas('siswa', function($query) use ($kelas1, $kelas2) {
            $query->whereIn('kelas', [$kelas1, $kelas2]);
        })->count();
        
        $bookingDireview = Booking::whereHas('siswa', function($query) use ($kelas1, $kelas2) {
            $query->whereIn('kelas', [$kelas1, $kelas2]);
        })->where('status', 'Direview')->count();
        
        $bookingDiterima = Booking::whereHas('siswa', function($query) use ($kelas1, $kelas2) {
            $query->whereIn('kelas', [$kelas1, $kelas2]);
        })->where('status', 'Diterima')->count();
        
        $bookingDitolak = Booking::whereHas('siswa', function($query) use ($kelas1, $kelas2) {
            $query->whereIn('kelas', [$kelas1, $kelas2]);
        })->where('status', 'Ditolak')->count();

        return view('kakonsli.dashboard', compact(
            'kelas1',
            'kelas2',
            'totalSiswa',
            'totalBooking',
            'bookingDireview',
            'bookingDiterima',
            'bookingDitolak'
        ));
    }

    /**
     * Show siswa list for kakonsli - can see both classes
     */
    public function siswas()
    {
        $user = auth()->user();
        $kelas1 = $user->kelas_id;
        $kelas2 = $user->kelas_second;
        $siswas = Siswa::whereIn('kelas', [$kelas1, $kelas2])->paginate(15);

        return view('kakonsli.siswas', compact('siswas', 'kelas1', 'kelas2'));
    }

    /**
     * Show bookings for kakonsli - can see both classes
     */
    public function bookings()
    {
        $user = auth()->user();
        $kelas1 = $user->kelas_id;
        $kelas2 = $user->kelas_second;
        $bookings = Booking::whereHas('siswa', function($query) use ($kelas1, $kelas2) {
            $query->whereIn('kelas', [$kelas1, $kelas2]);
        })->with('siswa')->paginate(15);

        return view('kakonsli.bookings', compact('bookings', 'kelas1', 'kelas2'));
    }
}
