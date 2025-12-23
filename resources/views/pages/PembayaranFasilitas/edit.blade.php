@extends('layouts.guest.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Pembayaran Fasilitas</h2>

    <form action="{{ route('pembayaran_fasilitas.update', $pembayaran->bayar_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="row">
            <!-- Kolom Kiri -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label>Peminjaman Fasilitas</label>
                    <select name="pinjam_id" class="form-control" required>
                        <option value="{{ $pembayaran->peminjaman->pinjam_id }}">{{ $pembayaran->peminjaman->tujuan }} - {{ $pembayaran->peminjaman->fasilitas->nama }}</option>
                        @foreach($peminjaman as $p)
                            <option value="{{ $p->pinjam_id }}">{{ $p->tujuan }} - {{ $p->fasilitas->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Tanggal Pembayaran</label>
                    <input type="date" name="tanggal" value="{{ $pembayaran->tanggal }}" class="form-control" required>
                </div>

               <div class="mb-3">
                <label>Jumlah</label>
                <input type="text" name="jumlah" 
                    value="{{ old('jumlah', number_format($pembayaran->jumlah, 0, ',', '.')) }}" 
                    class="form-control" 
                    placeholder="Masukkan Jumlah" 
                    required>
            </div>


            <!-- Kolom Kanan -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label>Metode Pembayaran</label>
                    <select name="metode" class="form-control" required>
                        <option value="Transfer Bank" {{ $pembayaran->metode == 'Transfer Bank' ? 'selected' : '' }}>Transfer Bank</option>
                        <option value="Tunai" {{ $pembayaran->metode == 'Tunai' ? 'selected' : '' }}>Tunai</option>
                        <option value="E-wallet" {{ $pembayaran->metode == 'E-wallet' ? 'selected' : '' }}>E-wallet</option>
                        <option value="Debit" {{ $pembayaran->metode == 'Debit' ? 'selected' : '' }}>Debit</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Keterangan</label>
                    <textarea name="keterangan" class="form-control">{{ $pembayaran->keterangan }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Upload Resi (boleh banyak)</label>
                    <input type="file" name="files[]" class="form-control" multiple>
                </div>
            </div>
        </div>

        <button class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection
