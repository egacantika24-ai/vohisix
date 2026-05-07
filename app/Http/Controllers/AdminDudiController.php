<?php

namespace App\Http\Controllers;

use App\Models\Dudi;
use Illuminate\Http\Request;

class AdminDudiController extends Controller
{
    /**
     * Display a listing of dudis
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $bidang = $request->input('bidang_usaha');
        $sortBy = $request->input('sort_by', 'newest');

        $dudis = Dudi::query();

        if ($search) {
            $dudis->where(function($q) use ($search) {
                $q->where('nama_dudi', 'like', "%$search%")
                  ->orWhere('bidang_usaha', 'like', "%$search%")
                  ->orWhere('alamat', 'like', "%$search%")
                  ->orWhereRaw('SOUNDEX(nama_dudi) = SOUNDEX(?)', [$search]);
            });
        }

        if ($bidang) {
            $dudis->where('bidang_usaha', $bidang);
        }

        // Apply sorting
        switch ($sortBy) {
            case 'oldest':
                $dudis->orderBy('created_at', 'asc');
                break;
            case 'name_asc':
                $dudis->orderBy('nama_dudi', 'asc');
                break;
            case 'name_desc':
                $dudis->orderBy('nama_dudi', 'desc');
                break;
            default: // newest
                $dudis->orderBy('created_at', 'desc');
        }

        $dudis = $dudis->paginate(10);

        // Get statistics
        $totalDudi = Dudi::count();
        $allBidang = Dudi::distinct('bidang_usaha')->pluck('bidang_usaha')->filter()->sort();
        $totalKuota = Dudi::sum('kuota') ?? 0;
        $bukuTerdaftar = \App\Models\Booking::whereIn('status', ['Direview', 'Diterima'])->count();

        return view('admin.dudi.index', compact('dudis', 'search', 'bidang', 'sortBy', 'totalDudi', 'allBidang', 'totalKuota', 'bukuTerdaftar'));
    }

    /**
     * Show form for creating new dudi
     */
    public function create()
    {
        return view('admin.dudi.create');
    }

    /**
     * Store dudi in database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_dudi' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'deskripsi' => 'nullable|string',
            'bidang_usaha' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'jumlah_pegawai' => 'nullable|string|max:255',
            'pembimbing_dudi' => 'nullable|string|max:255',
            'jam_masuk' => 'nullable|string|max:20',
            'jam_pulang' => 'nullable|string|max:20',
            'kota' => 'nullable|string|max:255',
            'kuota' => 'nullable|integer|min:0',
        ]);

        // Set default kuota if not provided
        if (!isset($validated['kuota'])) {
            $validated['kuota'] = 5;
        }

        Dudi::create($validated);

        return redirect()->route('admin.dudi.index')->with('success', 'DUDI berhasil ditambahkan');
    }

    /**
     * Show dudi details
     */
    public function show(Dudi $dudi)
    {
        return view('admin.dudi.show', compact('dudi'));
    }

    /**
     * Show form for editing dudi
     */
    public function edit(Dudi $dudi)
    {
        return view('admin.dudi.edit', compact('dudi'));
    }

    /**
     * Update dudi in database
     */
    public function update(Request $request, Dudi $dudi)
    {
        $validated = $request->validate([
            'nama_dudi' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'deskripsi' => 'nullable|string',
            'bidang_usaha' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'jumlah_pegawai' => 'nullable|string|max:255',
            'pembimbing_dudi' => 'nullable|string|max:255',
            'jam_masuk' => 'nullable|string|max:20',
            'jam_pulang' => 'nullable|string|max:20',
            'kota' => 'nullable|string|max:255',
            'kuota' => 'nullable|integer|min:0',
        ]);

        if (!isset($validated['kuota'])) {
            $validated['kuota'] = $dudi->kuota ?? 5;
        }

        $dudi->update($validated);

        return redirect()->route('admin.dudi.index')->with('success', 'DUDI berhasil diperbarui');
    }

    /**
     * Delete dudi
     */
    public function destroy(Dudi $dudi)
    {
        $dudi->delete();

        return redirect()->route('admin.dudi.index')->with('success', 'DUDI berhasil dihapus');
    }
}
