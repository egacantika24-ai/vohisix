<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminLoginController extends Controller
{
    /**
     * Display a listing of users
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $role = $request->input('role');
        $sortBy = $request->input('sort_by', 'newest');

        $users = User::query();

        if ($search) {
            $users->where(function($q) use ($search) {
                $q->where('username', 'like', "%$search%")
                  ->orWhere('name', 'like', "%$search%")
                  ->orWhereRaw('SOUNDEX(name) = SOUNDEX(?)', [$search]);
            });
        }

        if ($role) {
            $users->where('role', $role);
        }

        // Apply sorting
        switch ($sortBy) {
            case 'oldest':
                $users->orderBy('created_at', 'asc');
                break;
            case 'name_asc':
                $users->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $users->orderBy('name', 'desc');
                break;
            default: // newest
                $users->orderBy('created_at', 'desc');
        }

        $users = $users->paginate(10);

        // Get statistics
        $totalUser = User::count();
        $totalAdmin = User::where('role', 'admin')->count();
        $totalSiswa = User::where('role', 'siswa')->count();

        return view('admin.login.index', compact('users', 'search', 'role', 'sortBy', 'totalUser', 'totalAdmin', 'totalSiswa'));
    }

    /**
     * Show form for creating new user
     */
    public function create()
    {
        return view('admin.login.create');
    }

    /**
     * Store user in database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users',
            'name' => 'required|string|max:255',
            'role' => 'required|in:admin,siswa',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'username' => $validated['username'],
            'name' => $validated['name'],
            'role' => $validated['role'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.login.index')->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Show user details
     */
    public function show(User $user)
    {
        return view('admin.login.show', compact('user'));
    }

    /**
     * Show form for editing user
     */
    public function edit(User $user)
    {
        return view('admin.login.edit', compact('user'));
    }

    /**
     * Update user in database
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|in:admin,siswa',
            'password' => 'nullable|string|min:6',
        ]);

        $user->name = $validated['name'];
        $user->role = $validated['role'];

        if ($validated['password']) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('admin.login.index')->with('success', 'User berhasil diperbarui');
    }

    /**
     * Delete user
     */
    public function destroy(User $user)
    {
        // Cegah penghapusan admin pertama
        if ($user->role === 'admin' && User::where('role', 'admin')->count() <= 1) {
            return back()->with('error', 'Tidak bisa menghapus admin terakhir');
        }

        $user->delete();

        return redirect()->route('admin.login.index')->with('success', 'User berhasil dihapus');
    }
}
