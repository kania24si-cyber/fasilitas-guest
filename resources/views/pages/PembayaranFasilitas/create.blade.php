@extends('layouts.guest.app')

@section('content')
<div class="container mt-4">
    <h2>Tambah Pembayaran Fasilitas</h2>

    <form action="{{ route('pembayaran_fasilitas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <!-- Kolom Kiri -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label>Peminjaman Fasilitas</label>
                    <select name="pinjam_id" class="form-control" required>
                        <option value="">-- Pilih Peminjaman --</option>
                        @foreach($peminjaman as $p)
                        <option value="{{ $p->pinjam_id }}">{{ $p->tujuan }} - {{ $p->fasilitas->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Tanggal Pembayaran</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" required>
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label>Metode Pembayaran</label>
                    <select name="metode" class="form-control" required>
                        <option value="">-- Pilih Metode Pembayaran --</option>
                        <option value="Transfer Bank">Transfer Bank</option>
                        <option value="Tunai">Tunai</option>
                        <option value="E-wallet">E-wallet</option>
                        <option value="Debit">Debit</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Keterangan</label>
                    <textarea name="keterangan" class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label>Upload Resi (boleh banyak)</label>
                    <input type="file" name="files[]" class="form-control" multiple>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between mt-3">
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('pembayaran_fasilitas.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
