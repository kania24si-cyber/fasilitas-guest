<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $filterableColumns = ['role']; // bisa ditambah misal ['role'] jika ada role
        $searchableColumns = ['name', 'email'];

        $users = User::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->orderBy('id', 'desc')
            ->paginate(9)
            ->withQueryString();

        return view('pages.users.index', compact('users'));
    }

    public function create()
    {
        return view('pages.users.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:100',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
        'role' => 'required|in:admin,guest',
        'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $profilePicturePath = null;

    if ($request->hasFile('profile_picture')) {
        $profilePicturePath = $request->file('profile_picture')
            ->store('profile_pictures', 'public');
    }

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
        'profile_picture' => $profilePicturePath,
    ]);

    return redirect()->route('users.index')
        ->with('success', 'User berhasil ditambahkan.');
}


    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    // Validasi input
    $request->validate([
        'name' => 'required|string|max:100',
        'email' => 'required|email|unique:users,email,' . $user->id,  // Mengabaikan email lama
        'password' => 'nullable|min:8|confirmed',  // Password boleh kosong jika tidak diubah
        'role' => 'required|in:admin,guest',  // Validasi role harus 'admin' atau 'guest'
        'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validasi file gambar
    ]);

    $data = [
        'name' => $request->name,
        'email' => $request->email,
    ];

    // Update password jika disertakan
    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    // Handle update foto profil
    if ($request->hasFile('profile_picture')) {
        // Hapus foto lama jika ada
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        // Unggah foto profil baru
        $data['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
    }

    // Perbarui data pengguna
    $user->update($data);

    return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
}

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Delete the profile picture if exists
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }

    public function show($id)
{
    $user = User::findOrFail($id);
    return view('pages.users.show', compact('user'));
}

}
