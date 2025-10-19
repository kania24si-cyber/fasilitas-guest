@extends('guest.dashboard')
@section('content')
<div class="bg-light rounded p-4">
    <h5>Data Warga</h5>

    <a href="{{ route('warga.create') }}" class="btn btn-success mb-3">Tambah Warga</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No KTP</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Agama</th>
                <th>Pekerjaan</th>
                <th>Telp</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($warga as $item)
            <tr>
                <td>{{ $item->no_ktp }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->jenis_kelamin }}</td>
                <td>{{ $item->agama }}</td>
                <td>{{ $item->pekerjaan }}</td>
                <td>{{ $item->telp }}</td>
                <td>{{ $item->email }}</td>
                <td>
                    <a href="{{ route('warga.edit', $item->warga_id) }}" class="btn btn-info btn-sm">Edit</a>
                    <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection    