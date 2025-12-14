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
        // Mendefinisikan kolom yang bisa difilter dan dicari
        $filterable = ['fasilitas_id']; // Kolom yang bisa difilter
        $searchable = ['nama_syarat', 'deskripsi']; // Kolom yang bisa dicari

        // Mengambil data syarat fasilitas berdasarkan filter dan pencarian
        $syaratFasilitas = SyaratFasilitas::with('fasilitas')  // Eager load relasi fasilitas
            ->filter($request, $filterable)  // Apply filter berdasarkan request
            ->search($request, $searchable)  // Apply search berdasarkan request
            ->orderBy('syarat_id', 'DESC')  // Urutkan berdasarkan ID syarat
            ->paginate(10)  // Pagination 10 data per halaman
            ->withQueryString();  // Menyertakan query string agar bisa reset filter

        // Ambil data fasilitas untuk dropdown
        $fasilitas = FasilitasUmum::all();

        return view('pages.SyaratFasilitas.index', compact('syaratFasilitas', 'fasilitas'));
    }

    public function create()
    {
        $fasilitas = FasilitasUmum::all(); // Ambil semua fasilitas
        return view('pages.SyaratFasilitas.create', compact('fasilitas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fasilitas_id' => 'required|exists:fasilitas_umum,fasilitas_id',
            'nama_syarat' => 'required|string',
            'deskripsi' => 'required|string',
            'files.*' => 'nullable|mimes:jpg,jpeg,png,pdf,docx,xlsx|max:2048', // Validasi file
        ]);

        // Simpan data syarat fasilitas
        $syarat = SyaratFasilitas::create([
            'fasilitas_id' => $request->fasilitas_id,
            'nama_syarat' => $request->nama_syarat,
            'deskripsi' => $request->deskripsi,
        ]);

        // Simpan file ke tabel media jika ada
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

    public function show($id)
    {
        $syarat = SyaratFasilitas::findOrFail($id);
        $media = DB::table('media')
            ->where('ref_table', 'syarat_fasilitas')
            ->where('ref_id', $id)
            ->get();
        return view('pages.SyaratFasilitas.show', compact('syarat', 'media'));
    }
}
