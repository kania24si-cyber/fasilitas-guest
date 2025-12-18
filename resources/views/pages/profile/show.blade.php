@extends('layouts.guest.app')

@section('content')
<div class="container mt-4">
    <h1>Ubah Profil</h1>

    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Foto Profil --}}
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="profile_picture" class="form-label">Foto Profil:</label>
                <input type="file" name="profile_picture" id="profile_picture" class="form-control">
            </div>

            <div class="col-md-6">
                @if($user->profile_picture)
                    <label class="form-label">Foto Profil Saat Ini:</label>
                    <img src="{{ asset('storage/' . $user->profile_picture) }}" width="100" class="img-thumbnail">
                @endif
            </div>
        </div>

        {{-- Tombol Perbarui --}}
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Perbarui Profil</button>
        </div>
    </form>
</div>
@endsection
