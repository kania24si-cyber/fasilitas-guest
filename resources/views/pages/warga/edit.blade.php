@extends('layouts.guest.app')
@section('content')
<div class="bg-light rounded p-4">
    <h5>Edit Data Warga</h5>

    <form action="{{ route('warga.update', $item->warga_id) }}" method="POST">
        @csrf 
        @method('PUT')

        <div class="row">
            <!-- Kolom Kiri -->
            <div class="col-md-6">
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
                    <input type="text" name="agama" class="form-control" value="{{ old('agama', $item->agama) }}">
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label>Pekerjaan</label>
                    <input type="text" name="pekerjaan" class="form-control" value="{{ old('pekerjaan', $item->pekerjaan) }}">
                </div>

                <div class="mb-3">
                    <label>Nomor Telepon</label>
                    <input type="text" name="telp" class="form-control" value="{{ old('telp', $item->telp) }}">
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" value="{{ old('email', $item->email) }}">
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('warga.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
