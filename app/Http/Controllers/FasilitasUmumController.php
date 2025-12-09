<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FasilitasUmum;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;  // Correctly included for file handling

class FasilitasUmumController extends Controller
{
    public function index(Request $request)
    {
        $filterable = ['jenis'];
        $searchable = ['nama', 'alamat'];

        // Ambil data fasilitas dengan filter dan search
        $data = FasilitasUmum::filter($request, $filterable)
            ->search($request, $searchable)
            ->orderBy('fasilitas_id', 'DESC')
            ->paginate(9)
            ->withQueryString();

        // Ambil media untuk setiap fasilitas
        foreach ($data as $item) {
            $item->media = DB::table('media')
                ->where('ref_table', 'fasilitas_umum')
                ->where('ref_id', $item->fasilitas_id)
                ->get();
        }

        // Kirim data fasilitas dan media ke view
        return view('pages.fasilitas.index', compact('data'));
    }

    public function create()
    {
        // Mengambil data fasilitas dan lainnya untuk form fasilitas
        $fasilitas = FasilitasUmum::all();  // Menampilkan semua fasilitas umum yang ada (Jika perlu)

        return view('pages.fasilitas.create', compact('fasilitas'));  // Pastikan file view sesuai
    }

    public function store(Request $request)
    {
        // Validasi data fasilitas
        $request->validate([
            'nama' => 'required',
            'jenis' => 'required',
            'alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'kapasitas' => 'required|integer',
            'deskripsi' => 'required|string',
            'files.*' => 'nullable|mimes:jpg,jpeg,png,pdf,docx,xlsx|max:2048', // Validasi file jika ada
        ]);

        // Simpan data fasilitas ke dalam tabel fasilitas_umum
        $fasilitas = FasilitasUmum::create([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'alamat' => $request->alamat,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'kapasitas' => $request->kapasitas,
            'deskripsi' => $request->deskripsi,
        ]);

        // **PERBAIKI: Simpan file ke tabel media jika ada file yang di-upload**
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                if ($file->isValid()) {
                    // Generate nama file unik
                    $filename = time() . '_' . $file->getClientOriginalName();

                    // **PERBAIKAN: Menyimpan file dengan Storage disk public**
                    $filePath = $file->storeAs('uploads/media', $filename, 'public'); // [PERBAIKAN]

                    // Simpan file ke tabel media
                    DB::table('media')->insert([
                        'ref_table' => 'fasilitas_umum',
                        'ref_id' => $fasilitas->fasilitas_id,  // Menghubungkan dengan ID fasilitas
                        'file_name' => basename($filePath),
                        'mime_type' => $file->getMimeType(),
                        'caption' => null,  // Opsional, bisa ditambahkan jika diperlukan
                        'sort_order' => 0,  // Default urutan
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
        // Ambil data fasilitas berdasarkan ID
        $fasilitas = FasilitasUmum::findOrFail($id);

        // Kirim data fasilitas ke view 'edit'
        return view('pages.fasilitas.edit', compact('fasilitas'));
    }

    public function update(Request $request, $id)
    {
        // Ambil data fasilitas berdasarkan ID
        $item = FasilitasUmum::findOrFail($id);

        // Validasi data yang diterima dari form
        $validated = $request->validate([
            'nama' => 'required',
            'jenis' => 'required',
            'alamat' => 'required',
            'kapasitas' => 'nullable|integer',
            'rt' => 'nullable|integer',
            'rw' => 'nullable|integer',
            'deskripsi' => 'nullable|string',
        ]);

        // Update data fasilitas
        $item->update($validated);

        // **PERBAIKI: Simpan file media jika ada**
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                if ($file->isValid()) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $mime = $file->getMimeType();

                    // **PERBAIKAN: Menyimpan file dengan Storage disk public**
                    $filePath = $file->storeAs('uploads/media', $filename, 'public'); // [PERBAIKAN]

                    // Simpan informasi file ke tabel media
                    DB::table('media')->insert([
                        'ref_table' => 'fasilitas_umum',
                        'ref_id' => $item->fasilitas_id,  // Menghubungkan dengan ID fasilitas
                        'file_name' => basename($filePath),
                        'mime_type' => $mime,
                        'caption' => null,  // Bisa ditambahkan jika diperlukan
                        'sort_order' => 0,  // Default urutan (opsional)
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        // Redirect ke halaman index setelah update berhasil
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
        // Ambil data fasilitas berdasarkan ID
        $item = FasilitasUmum::findOrFail($id);

        // **PERBAIKI: Ambil semua media yang terkait dengan fasilitas ini**
        $media = DB::table('media')
            ->where('ref_table', 'fasilitas_umum')
            ->where('ref_id', $id)
            ->get();

        return view('pages.fasilitas.show', compact('item', 'media'));
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
}
