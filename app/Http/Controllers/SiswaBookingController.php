<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;

class SiswaBookingController extends Controller
{
    /**
     * Display siswa's bookings
     */
    public function index()
    {
        $siswa = Siswa::where('nis', Auth::user()->username)->firstOrFail();
        $bookings = Booking::with(['dudi'])
                            ->where('nis', $siswa->nis)
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);

        return view('siswa.booking.index', compact('bookings'));
    }

    /**
     * Show booking details
     */
    public function show(Booking $booking)
    {
        // Check jika booking milik siswa yang login
        if ($booking->nis !== Auth::user()->username) {
            abort(403);
        }

        return view('siswa.booking.show', compact('booking'));
    }
}
