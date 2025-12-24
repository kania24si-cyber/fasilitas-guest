<?php
namespace App\Http\Controllers;

use App\Models\SyaratFasilitas;
use App\Models\FasilitasUmum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SyaratFasilitasController extends Controller
{
  public function index(Request $request)
{
    $filterable = ['fasilitas_id'];
    $searchable = ['nama_syarat', 'deskripsi'];

    $syaratFasilitas = SyaratFasilitas::with(['fasilitas', 'media'])
        ->filter($request, $filterable)
        ->search($request, $searchable)
        ->orderBy('syarat_id', 'DESC')
        ->paginate(10)
        ->withQueryString();

    $fasilitas = FasilitasUmum::all(); 
    // Path for the placeholder image
    $placeholderImage = asset('assets/img/placeholder.jpg'); // Make sure this is correct

     return view('pages.SyaratFasilitas.index', compact('syaratFasilitas', 'placeholderImage', 'fasilitas'));
}



    public function create()
    {
        $fasilitas = FasilitasUmum::all(); 
        return view('pages.SyaratFasilitas.create', compact('fasilitas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fasilitas_id' => 'required|exists:fasilitas_umum,fasilitas_id',
            'nama_syarat' => 'required|string',
            'deskripsi' => 'required|string',
            'files.*' => 'nullable|mimes:jpg,jpeg,png,pdf,docx,xlsx|max:2048',
        ]);

        $syarat = SyaratFasilitas::create([
            'fasilitas_id' => $request->fasilitas_id,
            'nama_syarat' => $request->nama_syarat,
            'deskripsi' => $request->deskripsi,
        ]);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                if ($file->isValid()) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $filePath = $file->storeAs('uploads/media', $filename, 'public');

                    DB::table('media')->insert([
                        'ref_table' => 'syarat_fasilitas',
                        'ref_id' => $syarat->syarat_id,
                        'file_name' => basename($filePath),
                        'mime_type' => $file->getMimeType(),
                        'caption' => null,
                        'sort_order' => 0,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        return redirect()->route('syarat_fasilitas.index')->with('success', 'Syarat fasilitas berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $syarat = SyaratFasilitas::findOrFail($id);
        $fasilitas = FasilitasUmum::all();
        return view('pages.SyaratFasilitas.edit', compact('syarat', 'fasilitas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fasilitas_id' => 'required|exists:fasilitas_umum,fasilitas_id',
            'nama_syarat' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        $syarat = SyaratFasilitas::findOrFail($id);
        $syarat->update($request->all());

        // Simpan file baru jika ada
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                if ($file->isValid()) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $filePath = $file->storeAs('uploads/media', $filename, 'public');

                    DB::table('media')->insert([
                        'ref_table' => 'syarat_fasilitas',
                        'ref_id' => $syarat->syarat_id,
                        'file_name' => basename($filePath),
                        'mime_type' => $file->getMimeType(),
                        'caption' => null,
                        'sort_order' => 0,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        return redirect()->route('syarat_fasilitas.index')->with('success', 'Syarat fasilitas berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $syarat = SyaratFasilitas::findOrFail($id);
        $syarat->delete();
        return redirect()->route('syarat_fasilitas.index')->with('success', 'Syarat fasilitas berhasil dihapus!');
    }


   public function deleteMedia($media_id)
    {
        // Cari media berdasarkan ID
        $media = DB::table('media')->where('media_id', $media_id)->first();

        if ($media) {
            // Hapus file fisik dari server
            $filePath = public_path('uploads/media/' . $media->file_name);
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            // Hapus record dari tabel media
            DB::table('media')->where('media_id', $media_id)->delete();

            return back()->with('success', 'Media berhasil dihapus!');
        }

        return back()->with('error', 'Media tidak ditemukan!');
    }
    
    public function show($id)
{
    $syarat = SyaratFasilitas::findOrFail($id);

    $media = DB::table('media')
        ->where('ref_table', 'syarat_fasilitas')
        ->where('ref_id', $id)
        ->get();


    $placeholderImage = asset('assets/img/placeholder.jpg');  

    return view('pages.SyaratFasilitas.show', compact(
        'syarat',
        'media',
        'placeholderImage'
    ));
}
}
