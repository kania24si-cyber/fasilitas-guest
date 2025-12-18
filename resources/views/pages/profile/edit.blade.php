@extends('layouts.guest.app')
@section('content')

<h1>Ubah Profil</h1>

@if(session('success'))
    <div style="color: green;">{{ session('success') }}</div>
@endif

<form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label>Foto Profil:</label>
    <input type="file" name="profile_picture">
    <br><br>

    @if($user->profile_picture)
        <img src="{{ asset('storage/'.$user->profile_picture) }}" width="100">
        <br><br>
    @endif

    <button type="submit">Perbarui Profil</button>
</form>

@endsection
