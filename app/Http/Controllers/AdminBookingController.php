<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Siswa;
use App\Models\Dudi;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    /**
     * Display a listing of bookings
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        $sortBy = $request->input('sort_by', 'newest');

        $bookings = Booking::with(['siswa', 'dudi']);

        if ($search) {
            $bookings->whereHas('siswa', function($query) use ($search) {
                $query->where('nama', 'like', "%$search%")
                      ->orWhere('nis', 'like', "%$search%");
            });
        }

        if ($status && $status !== '') {
            $bookings->where('status', $status);
        }

        // Apply sorting
        switch ($sortBy) {
            case 'oldest':
                $bookings->orderBy('created_at', 'asc');
                break;
            case 'siswa_asc':
                $bookings->orderBy('nis', 'asc');
                break;
            case 'siswa_desc':
                $bookings->orderBy('nis', 'desc');
                break;
            default: // newest
                $bookings->orderBy('created_at', 'desc');
        }

        $bookings = $bookings->paginate(10);

        // Get statistics
        $totalBooking = Booking::count();
        $bookingDireview = Booking::where('status', 'Direview')->count();
        $bookingDiterima = Booking::where('status', 'Diterima')->count();
        $bookingDitolak = Booking::where('status', 'Ditolak')->count();

        return view('admin.booking.index', compact('bookings', 'search', 'status', 'sortBy', 'totalBooking', 'bookingDireview', 'bookingDiterima', 'bookingDitolak'));
    }

    /**
     * Show booking details
     */
    public function show(Booking $booking)
    {
        return view('admin.booking.show', compact('booking'));
    }

    /**
     * Show form for editing booking status
     */
    public function edit(Booking $booking)
    {
        return view('admin.booking.edit', compact('booking'));
    }

    /**
     * Update booking status
     */
    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => 'required|in:Direview,Diterima,Ditolak',
        ]);

        $booking->update($validated);

        return redirect()->route('admin.booking.index')->with('success', 'Status booking berhasil diperbarui');
    }

    /**
     * Delete booking
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('admin.booking.index')->with('success', 'Booking berhasil dihapus');
    }
}
