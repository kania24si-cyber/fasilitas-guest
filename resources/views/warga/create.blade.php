@extends('guest.dashboard')
@section('content')
<div class="bg-light rounded p-4">
    <h5>Tambah Data Warga</h5>

    <form action="{{ route('warga.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>No KTP</label>
            <input type="text" name="no_ktp" class="form-control" value="{{ old('no_ktp') }}">
            @error('no_ktp') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama') }}">
            @error('nama') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control">
                <option value="">-- Pilih --</option>
                <option value="Laki-laki" {{ old('jenis_kelamin')=='Laki-laki'?'selected':'' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin')=='Perempuan'?'selected':'' }}>Perempuan</option>
            </select>
            @error('jenis_kelamin') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Agama</label>
            <input type="text" name="agama" class="form-control" value="{{ old('agama', $warga->agama ?? '') }}">
        </div>

        <div class="mb-3">
            <label>Pekerjaan</label>
            <input type="text" name="pekerjaan" class="form-control" value="{{ old('pekerjaan', $warga->pekerjaan ?? '') }}">
        </div>
        
        <div class="mb-3">
            <label> Nomor Telepon</label>
            <input type="text" name="telp" class="form-control" value="{{ old('telp') }}">
            @error('telp') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
              @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('warga.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection