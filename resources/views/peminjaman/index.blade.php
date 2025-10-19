@extends('guest.dashboard')
@section('content')
<div class="bg-light rounded p-4">
<h5>Data Peminjaman</h5>

    <a href="{{ route('peminjaman.create') }}" class="btn btn-success mb-3">Tambah Peminjaman</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Warga</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Tujuan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peminjaman as $item)
            <tr>
                <td>{{ $item->warga->nama ?? '-' }}</td>
                <td>{{ $item->tanggal_mulai }}</td>
                <td>{{ $item->tanggal_selesai }}</td>
                <td>{{ $item->tujuan }}</td>
                <td>{{ ucfirst($item->status) }}</td>
                <td>
                    <a href="{{ route('peminjaman.edit', $item->pinjam_id) }}" class="btn btn-info btn-sm">Edit</a>
                    <form action="{{ route('peminjaman.destroy', $item->pinjam_id) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection