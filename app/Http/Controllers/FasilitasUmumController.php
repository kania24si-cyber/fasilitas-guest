<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FasilitasUmum;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;  

class FasilitasUmumController extends Controller
{
    public function index(Request $request)
{
    $filterable = ['jenis'];
    $searchable = ['nama', 'alamat'];

    $data = FasilitasUmum::filter($request, $filterable)
        ->search($request, $searchable)
        ->orderBy('fasilitas_id', 'DESC')
        ->paginate(9)
        ->withQueryString();

    $fasilitas = FasilitasUmum::all();  

    foreach ($data as $item) {
        $item->media = DB::table('media')
            ->where('ref_table', 'fasilitas_umum')
            ->where('ref_id', $item->fasilitas_id)
            ->get();
    }

    $placeholderImage = asset('assets/img/placeholder.jpg');  

    return view('pages.fasilitas.index', compact('data', 'fasilitas', 'placeholderImage'));
}



    public function create()
    {
        // Mengambil data fasilitas dan lainnya untuk form fasilitas
        $fasilitas = FasilitasUmum::all();  // Menampilkan semua fasilitas umum yang ada (Jika perlu)

        return view('pages.fasilitas.create', compact('fasilitas'));  // Pastikan file view sesuai
    }

    public function store(Request $request)
    {
       
        $request->validate([
            'nama' => 'required',
            'jenis' => 'required',
            'alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'kapasitas' => 'required|integer',
            'deskripsi' => 'required|string',
            'files.*' => 'nullable|mimes:jpg,jpeg,png,pdf,docx,xlsx|max:2048', 
        ]);

        $fasilitas = FasilitasUmum::create([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'alamat' => $request->alamat,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'kapasitas' => $request->kapasitas,
            'deskripsi' => $request->deskripsi,
        ]);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                if ($file->isValid()) {
                  
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $filePath = $file->storeAs('uploads/media', $filename, 'public'); 

                    DB::table('media')->insert([
                        'ref_table' => 'fasilitas_umum',
                        'ref_id' => $fasilitas->fasilitas_id,  
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

        return redirect()->route('fasilitas.index')->with('success', 'Data fasilitas berhasil disimpan dengan media!');
    }

    public function edit($id)
    {
  
        $fasilitas = FasilitasUmum::findOrFail($id);

        return view('pages.fasilitas.edit', compact('fasilitas'));
    }

    public function update(Request $request, $id)
    {
        $item = FasilitasUmum::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required',
            'jenis' => 'required',
            'alamat' => 'required',
            'kapasitas' => 'nullable|integer',
            'rt' => 'nullable|integer',
            'rw' => 'nullable|integer',
            'deskripsi' => 'nullable|string',
        ]);

        $item->update($validated);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                if ($file->isValid()) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $mime = $file->getMimeType();


                    $filePath = $file->storeAs('uploads/media', $filename, 'public'); 
                    DB::table('media')->insert([
                        'ref_table' => 'fasilitas_umum',
                        'ref_id' => $item->fasilitas_id,  
                        'file_name' => basename($filePath),
                        'mime_type' => $mime,
                        'caption' => null,  
                        'sort_order' => 0,  
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
        return redirect()->route('fasilitas.index')->with('success', 'Data fasilitas berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $item = FasilitasUmum::findOrFail($id);
        $item->delete();

        return redirect()->route('fasilitas.index')->with('success', 'Data berhasil dihapus!');
    }

    public function show($id)
{

    $item = FasilitasUmum::findOrFail($id);

    $media = DB::table('media')
        ->where('ref_table', 'fasilitas_umum')
        ->where('ref_id', $id)
        ->get();

    $placeholderImage = asset('assets/img/placeholder.jpg');  

    return view('pages.fasilitas.show', compact('item', 'media', 'placeholderImage'));
}


    public function deleteMedia($media_id)
    {
     
        $media = DB::table('media')->where('media_id', $media_id)->first();

        if ($media) {
    
            $filePath = public_path('uploads/media/' . $media->file_name);
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            DB::table('media')->where('media_id', $media_id)->delete();

            return back()->with('success', 'Media berhasil dihapus!');
        }

        return back()->with('error', 'Media tidak ditemukan!');
    }
}
