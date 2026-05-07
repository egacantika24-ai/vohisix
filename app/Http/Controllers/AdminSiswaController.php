<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use App\Models\Berkas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminSiswaController extends Controller
{
    /**
     * Display a listing of siswas
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $kelas = $request->input('kelas');
        $sortBy = $request->input('sort_by', 'newest');

        $siswas = Siswa::query();

        if ($search) {
            $siswas->where(function($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                  ->orWhere('nis', 'like', "%$search%")
                  ->orWhere('kelas', 'like', "%$search%")
                  ->orWhereRaw('SOUNDEX(nama) = SOUNDEX(?)', [$search]);
            });
        }

        if ($kelas) {
            $siswas->where('kelas', $kelas);
        }

        // Apply sorting
        switch ($sortBy) {
            case 'oldest':
                $siswas->orderBy('created_at', 'asc');
                break;
            case 'name_asc':
                $siswas->orderBy('nama', 'asc');
                break;
            case 'name_desc':
                $siswas->orderBy('nama', 'desc');
                break;
            default: // newest
                $siswas->orderBy('created_at', 'desc');
        }

        $siswas = $siswas->paginate(10);

        // Get statistics
        $totalSiswa = Siswa::count();
        $allKelas = Siswa::distinct('kelas')->pluck('kelas')->filter()->sort();
        $totalBerkas = Berkas::count();
        $totalBooking = \App\Models\Booking::count();

        return view('admin.siswa.index', compact('siswas', 'search', 'kelas', 'sortBy', 'totalSiswa', 'allKelas', 'totalBerkas', 'totalBooking'));
    }

    /**
     * Show form for creating new siswa
     */
    public function create()
    {
        return view('admin.siswa.create');
    }

    /**
     * Store siswa in database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'required|unique:siswas',
            'nama' => 'required|string|max:255',
            'kelas' => 'required|in:XIII SIJA 1,XIII SIJA 2',
            // allow a broad set of common image file types; skip the `image` rule so unknown formats
            // (webp/heic/etc.) don't trigger "must be an image" errors
            'foto' => 'nullable|file|mimes:jpg,jpeg,png,webp,gif,bmp,heic,heif|max:2048',
            // password no longer provided here, it's defaulted in create view if needed
        ]);

        // Generate password default to NIS if not specified (handled at view level now)
        $password = $validated['nis'];

        // Handle photo upload
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('siswas', 'public');
        }

        // Buat siswa
        Siswa::create([
            'nis' => $validated['nis'],
            'nama' => $validated['nama'],
            'kelas' => $validated['kelas'],
            'foto' => $fotoPath,
        ]);

        // Buat user untuk login
        User::create([
            'username' => $validated['nis'],
            'name' => $validated['nama'],
            'role' => 'siswa',
            'password' => Hash::make($password),
        ]);

        // Buat berkas kosong
        Berkas::create([
            'nis' => $validated['nis'],
            'lengkap' => false,
        ]);

        // Return view dengan credentials
        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Siswa berhasil ditambahkan')
            ->with('siswa_created', [
                'username' => $validated['nis'],
                'password' => $password,
                'nama' => $validated['nama']
            ]);
    }

    /**
     * Show siswa details
     */
    public function show(Siswa $siswa)
    {
        return view('admin.siswa.show', compact('siswa'));
    }

    /**
     * Show form for editing siswa
     */
    public function edit(Siswa $siswa)
    {
        return view('admin.siswa.edit', compact('siswa'));
    }

    /**
     * Update siswa in database
     */
    public function update(Request $request, Siswa $siswa)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kelas' => 'required|in:XIII SIJA 1,XIII SIJA 2',
            'nis' => 'nullable|string|unique:siswas,nis,' . $siswa->nis . ',nis',
            'foto' => 'nullable|file|mimes:jpg,jpeg,png,webp,gif,bmp,heic,heif|max:2048',
        ]);

        // Handle new photo upload if present
        if ($request->hasFile('foto')) {
            // delete old photo if exists
            if ($siswa->foto && \Storage::disk('public')->exists($siswa->foto)) {
                \Storage::disk('public')->delete($siswa->foto);
            }
            $validated['foto'] = $request->file('foto')->store('siswas', 'public');
        }

        // Jika NIS berubah, update juga di User dan Berkas
        $nisLama = $siswa->nis;
        if (isset($validated['nis']) && $validated['nis'] !== $nisLama) {
            $nisBaru = $validated['nis'];
            
            // Gunakan transaction dan disable FK checks sementara
            \DB::beginTransaction();
            try {
                \DB::statement('SET FOREIGN_KEY_CHECKS=0');
                
                // Update semua tabel sesuai urutan yang aman
                User::where('username', $nisLama)->update([
                    'username' => $nisBaru,
                    'password' => Hash::make($nisBaru),
                ]);
                
                Berkas::where('nis', $nisLama)->update(['nis' => $nisBaru]);
                $siswa->update($validated);
                
                \DB::statement('SET FOREIGN_KEY_CHECKS=1');
                \DB::commit();
                
                return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil diperbarui. Username dan password siswa berubah mengikuti NIS baru.');
            } catch (\Exception $e) {
                \DB::rollBack();
                \DB::statement('SET FOREIGN_KEY_CHECKS=1');
                return back()->with('error', 'Gagal mengubah NIS: ' . $e->getMessage());
            }
        }
        
        $siswa->update($validated);

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil diperbarui');
    }

    /**
     * Delete siswa
     */
    public function destroy(Siswa $siswa)
    {
        // Hapus user terkait
        User::where('username', $siswa->nis)->delete();

        $siswa->delete();

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil dihapus');
    }
}
