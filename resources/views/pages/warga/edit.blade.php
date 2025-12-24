@extends('layouts.guest.app')
@section('content')
<div class="bg-light rounded p-4">
    <h5>Edit Data Warga</h5>

    <form action="{{ route('warga.update', $item->warga_id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>No KTP</label>
            <input type="text" name="no_ktp" class="form-control" value="{{ old('no_ktp', $item->no_ktp) }}">
        </div>

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama', $item->nama) }}">
        </div>

        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control">
                <option value="Laki-laki" {{ old('jenis_kelamin', $item->jenis_kelamin)=='Laki-laki'?'selected':'' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin', $item->jenis_kelamin)=='Perempuan'?'selected':'' }}>Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Agama</label>
            <input type="text" name="Agama" class="form-control" value="{{ old('agama', $item->agama) }}">
        </div>

        <div class="mb-3">
            <label>Pekerjaan</label>
            <input type="text" name="Pekerjaan" class="form-control" value="{{ old('pekerjaan', $item->pekerjaan) }}">
        </div>

         <div class="mb-3">
            <label>Nomor Telepon</label>
            <input type="text" name="Telp" class="form-control" value="{{ old('telp', $item->telp) }}">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="text" name="Email" class="form-control" value="{{ old('email', $item->email) }}">
        </div>

        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="{{ route('warga.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
