@extends('layouts.guest.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Pembayaran Fasilitas</h2>

    <form action="{{ route('pembayaran_fasilitas.update', $pembayaran->bayar_id) }}"
          method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- ================== KOLOM KIRI ================== -->
            <div class="col-md-6">

                <div class="mb-3">
                    <label>Peminjaman Fasilitas</label>
                    <select name="pinjam_id" class="form-control" required>
                        <option value="">-- Pilih Peminjaman --</option>
                        @foreach($peminjaman as $p)
                            <option value="{{ $p->pinjam_id }}"
                                {{ old('pinjam_id', $pembayaran->pinjam_id) == $p->pinjam_id ? 'selected' : '' }}>
                                {{ $p->tujuan }} |
                                {{ optional($p->fasilitas)->nama }} |
                                {{ optional($p->warga)->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Tanggal Pembayaran</label>
                    <input type="date"
                           name="tanggal"
                           value="{{ old('tanggal', $pembayaran->tanggal) }}"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Jumlah</label>
                    <input type="text"
                           name="jumlah"
                           value="{{ old('jumlah', number_format($pembayaran->jumlah, 0, ',', '.')) }}"
                           class="form-control"
                           placeholder="Masukkan Jumlah"
                           required>
                </div>

            </div>

            <!-- ================== KOLOM KANAN ================== -->
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
                    <textarea name="keterangan"
                              class="form-control"
                              rows="3">{{ old('keterangan', $pembayaran->keterangan) }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Upload Resi (boleh banyak)</label>
                    <input type="file" name="files[]" class="form-control" multiple>
                </div>

            </div>
        </div>

        <!-- ================== BUTTON ================== -->
<div class="d-flex gap-2 mt-4">
    <button type="submit" class="btn btn-primary">
        Update
    </button>

    <a href="{{ route('pembayaran_fasilitas.index') }}"
       class="btn btn-secondary">
        Batal
    </a>
</div>


    </form>
</div>
@endsection
