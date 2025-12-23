@extends('layouts.guest.app') 

@section('content')
<div class="container">
    <h2>Edit Pengguna</h2>

    {{-- Notifikasi Kesalahan --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Notifikasi Sukses --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group mt-2">
            <label>Nama</label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="form-group mt-2">
            <label>Email</label>
            <input type="email" name="email" class="form-control"
                   value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="form-group mt-2">
            <label>Role</label>
            <select name="role" class="form-control" required>
                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="guest" {{ old('role', $user->role) === 'guest' ? 'selected' : '' }}>Guest</option>
            </select>
        </div>

        <div class="form-group mt-2">
            <label>Password Lama</label>
            <input type="text" class="form-control" value="********" readonly>
        </div>

        <div class="form-group mt-2">
            <label>Password Baru (opsional)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="form-group mt-2">
            <label>Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <div class="form-group mt-2">
            <label>Foto Profil</label>
            <input type="file" name="profile_picture" class="form-control">
        </div>

        @if ($user->profile_picture)
        <img src="{{ Storage::url($user->profile_picture) }}" width="80" class="mt-2 rounded">
    @endif


        <button type="submit" class="btn btn-primary mt-3">Perbarui</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </form>
</div>
@endsection
