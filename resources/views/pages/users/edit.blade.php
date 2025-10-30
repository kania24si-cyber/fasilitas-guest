@extends('layouts.guest.app')

@section('content')
<div class="container">
    <h2>Edit User</h2>

    {{-- Notifikasi Error --}}
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

    {{-- Notifikasi Success --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mt-2">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="form-group mt-2">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="form-group mt-2">
            <label>Password Lama (Hashed)</label>
            <input type="text" class="form-control" value="{{ $user->password }}" readonly>
        </div>

        <div class="form-group mt-2">
            <label>Password Baru (Kosongkan jika tidak ingin ubah)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="form-group mt-2">
            <label>Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Perbarui</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </form>
</div>
@endsection
