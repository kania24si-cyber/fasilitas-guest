<?php
namespace App\Http\Controllers;

use App\Models\PetugasFasilitas;
use App\Models\FasilitasUmum;
use App\Models\Warga;
use Illuminate\Http\Request;

class PetugasFasilitasController extends Controller
{
    public function index(Request $request) 
    {
        $filterable = ['fasilitas_id', 'petugas_warga_id'];  
        $searchable = ['peran'];  

        $petugas = PetugasFasilitas::with(['fasilitas', 'petugas_warga'])
            ->filter($request, $filterable) 
            ->search($request, $searchable) 
            ->orderBy('petugas_id', 'DESC') 
            ->paginate(10)  
            ->withQueryString();

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
