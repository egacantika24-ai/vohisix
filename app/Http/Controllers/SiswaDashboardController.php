<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Dudi;
use App\Models\Panduan;
use Illuminate\Support\Facades\Auth;

class SiswaDashboardController extends Controller
{
    /**
     * Show siswa dashboard
     */
    public function index()
    {
        $siswa = Siswa::where('nis', Auth::user()->username)->firstOrFail();
        $berkas = $siswa->berkas;
        $bookingCount = $siswa->bookings()->count();
        $bookingDiterima = $siswa->bookings()->where('status', 'Diterima')->count();
        
        // Get DUDI recommendations (limit to 5 most recent with available kuota)
        $dudiRekomendasi = Dudi::where('kuota', '>', 0)->latest()->limit(5)->get();
        
        // Get panduan
        $panduan = Panduan::first();

        return view('siswa.dashboard', compact('siswa', 'berkas', 'bookingCount', 'bookingDiterima', 'dudiRekomendasi', 'panduan'));
    }
}
