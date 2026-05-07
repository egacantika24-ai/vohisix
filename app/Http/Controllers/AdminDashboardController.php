<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Dudi;
use App\Models\Booking;

class AdminDashboardController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function index()
    {
        $totalSiswa = Siswa::count();
        $totalDudi = Dudi::count();
        $totalBooking = Booking::count();
        $bookingDireview = Booking::where('status', 'Direview')->count();
        $bookingDiterima = Booking::where('status', 'Diterima')->count();
        $bookingDitolak = Booking::where('status', 'Ditolak')->count();

        return view('admin.dashboard', compact(
            'totalSiswa',
            'totalDudi',
            'totalBooking',
            'bookingDireview',
            'bookingDiterima',
            'bookingDitolak'
        ));
    }
}
