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
        $filterableColumns = ['role']; 
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
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email',
        'role' => 'required|in:admin,guest',
        'password' => 'required|string|min:6|confirmed',
        'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validasi gambar
    ]);

    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->role = $request->role;
    $user->password = bcrypt($request->password);

    if ($request->hasFile('profile_picture')) {
        // Jika ada gambar, simpan ke storage dan ambil path-nya
        $path = $request->file('profile_picture')->store('profile_pictures', 'public');
        $user->profile_picture = $path;
    }

    $user->save();

    return redirect()->route('users.index')->with('success', 'User created successfully!');
}



    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $id,
        'role' => 'required|in:admin,guest',
        'password' => 'nullable|string|min:6|confirmed',
        'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validasi gambar
    ]);

    $user = User::findOrFail($id);
    $user->name = $request->name;
    $user->email = $request->email;
    $user->role = $request->role;

    if ($request->filled('password')) {
        $user->password = bcrypt($request->password);
    }

    if ($request->hasFile('profile_picture')) {
        // Jika ada gambar baru, hapus gambar lama dan simpan yang baru
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }
        $path = $request->file('profile_picture')->store('profile_pictures', 'public');
        $user->profile_picture = $path;
    }

    $user->save();

    return redirect()->route('users.index')->with('success', 'User updated successfully!');
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
