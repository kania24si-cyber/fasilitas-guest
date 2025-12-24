<?php
namespace App\Http\Controllers;

use App\Models\PetugasFasilitas;
use App\Models\FasilitasUmum;
use App\Models\Warga;
use Illuminate\Http\Request;

class PetugasFasilitasController extends Controller
{
    public function index(Request $request) // Tambahkan parameter Request $request
    {
        // Mendefinisikan kolom yang bisa difilter
        $filterable = ['fasilitas_id', 'petugas_warga_id'];  // Kolom yang bisa difilter
        $searchable = ['peran'];  // Kolom yang bisa dicari

        // Mengambil data petugas fasilitas berdasarkan filter dan pencarian
        $petugas = PetugasFasilitas::with(['fasilitas', 'petugas_warga']) // Eager load relasi fasilitas dan petugas_warga
            ->filter($request, $filterable)  // Apply filter berdasarkan request
            ->search($request, $searchable)  // Apply search berdasarkan request
            ->orderBy('petugas_id', 'DESC') // Urutkan berdasarkan ID petugas
            ->paginate(10)  // Pagination 10 data per halaman
            ->withQueryString(); // Menyertakan query string agar bisa reset filter

        // Ambil data warga dan fasilitas untuk dropdown di form
        $warga = Warga::all();
        $fasilitas = FasilitasUmum::all();

        return view('pages.PetugasFasilitas.index', compact('petugas', 'warga', 'fasilitas'));
    }

   public function create()
{
    $fasilitas = FasilitasUmum::all();
    $warga = Warga::all();
    return view('pages.PetugasFasilitas.create', compact('fasilitas', 'warga'));
}


    public function store(Request $request)
    {
        $request->validate([
            'fasilitas_id' => 'required|exists:fasilitas_umum,fasilitas_id',
            'petugas_warga_id' => 'required|exists:warga,warga_id',
            'peran' => 'required|string|max:50',
        ]);

        PetugasFasilitas::create($request->all());

        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil ditambahkan');
    }

    public function edit($id)
    {
        $petugas = PetugasFasilitas::findOrFail($id);
        $fasilitas = FasilitasUmum::all();
        $warga = Warga::all();
        return view('pages.PetugasFasilitas.edit', compact('petugas', 'fasilitas', 'warga'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fasilitas_id' => 'required|exists:fasilitas_umum,fasilitas_id',
            'petugas_warga_id' => 'required|exists:warga,warga_id',
            'peran' => 'required|string|max:50',
        ]);

        $petugas = PetugasFasilitas::findOrFail($id);
        $petugas->update($request->all());

        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil diperbarui');
    }

    public function destroy($id)
    {
        $petugas = PetugasFasilitas::findOrFail($id);
        $petugas->delete();

        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil dihapus');
    }
    
    public function show($id)
{
    $petugas = PetugasFasilitas::with(['fasilitas', 'petugas_warga'])->findOrFail($id);
    return view('pages.PetugasFasilitas.show', compact('petugas'));
}

}
