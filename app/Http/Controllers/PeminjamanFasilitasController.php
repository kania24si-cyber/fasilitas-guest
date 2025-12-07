<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Warga;
use Illuminate\Http\Request;
use App\Models\FasilitasUmum;
use Illuminate\Support\Facades\DB;
use App\Models\PeminjamanFasilitas;
use Illuminate\Support\Facades\Storage;

class PeminjamanFasilitasController extends Controller
{
    public function index(Request $request)
{
    $filterable = ['status', 'fasilitas_id', 'warga_id'];
    $searchable = ['tujuan'];

    $data = PeminjamanFasilitas::with(['warga', 'fasilitas'])
        ->filter($request, $filterable)
        ->search($request, $searchable)
        ->orderBy('pinjam_id', 'DESC')
        ->paginate(9)
        ->withQueryString();

    // Ambil media untuk setiap peminjaman
    foreach ($data as $item) {
        $item->media = DB::table('media')
            ->where('ref_table', 'peminjaman_fasilitas')
            ->where('ref_id', $item->pinjam_id)
            ->get();
    }

    $warga = Warga::all();
    $fasilitas = FasilitasUmum::all();

    return view('pages.peminjaman.index', compact('data', 'warga', 'fasilitas'));
}

    public function create()
    {
        $warga = Warga::all();
        $fasilitas = FasilitasUmum::all();
        return view('pages.peminjaman.create', compact('warga', 'fasilitas'));
    }

  public function store(Request $request)
{
    // Validasi data
    $validated = $request->validate([
        'warga_id' => 'required|exists:warga,warga_id',
        'fasilitas_id' => 'required|exists:fasilitas_umum,fasilitas_id',
        'tanggal_mulai' => 'required|date',
        'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        'tujuan' => 'required|string',
        'total_biaya' => 'nullable|numeric',
        'files.*' => 'nullable|mimes:jpg,jpeg,png,pdf,docx,xlsx|max:2048',  // Validasi untuk file media lainnya
    ]);

    // Simpan data peminjaman fasilitas
    $peminjaman = PeminjamanFasilitas::create($validated);

    // Simpan bukti pembayaran jika ada
    if ($request->hasFile('bukti_bayaran')) {
        $path = $request->file('bukti_bayaran')->store('bukti_bayaran', 'public');

        // Simpan bukti pembayaran ke tabel media
        DB::table('media')->insert([
            'ref_table' => 'peminjaman_fasilitas',
            'ref_id' => $peminjaman->pinjam_id,
            'file_name' => basename($path),
            'mime_type' => $request->file('bukti_bayaran')->getMimeType(),
            'caption' => 'Bukti Pembayaran',
            'sort_order' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    // Simpan file media lainnya jika ada
    if ($request->hasFile('files')) {
        foreach ($request->file('files') as $file) {
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/media'), $filename);

            // Simpan file media ke tabel media
            DB::table('media')->insert([
                'ref_table' => 'peminjaman_fasilitas',  // Menghubungkan dengan peminjaman fasilitas
                'ref_id' => $peminjaman->pinjam_id,    // ID peminjaman fasilitas yang baru disimpan
                'file_name' => $filename,
                'mime_type' => $file->getMimeType(),
                'caption' => null,  // Bisa ditambahkan caption jika diperlukan
                'sort_order' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman fasilitas berhasil ditambahkan.');
}

public function edit($id)
{
    // Ambil data peminjaman berdasarkan ID
    $item = PeminjamanFasilitas::findOrFail($id);

    // Ambil data warga dan fasilitas untuk dropdown
    $warga = Warga::all();
    $fasilitas = FasilitasUmum::all();

    // Ambil media yang terkait dengan peminjaman ini
    $media = DB::table('media')
        ->where('ref_table', 'peminjaman_fasilitas')
        ->where('ref_id', $id)
        ->get();

    // Kirim data ke view 'edit' untuk peminjaman fasilitas
    return view('pages.peminjaman.edit', compact('item', 'warga', 'fasilitas', 'media'));
}



   public function update(Request $request, $id)
{
    // Ambil data peminjaman berdasarkan ID
    $item = PeminjamanFasilitas::findOrFail($id);

    // Validasi data yang diterima dari form
    $validated = $request->validate([
        'warga_id' => 'required|exists:warga,warga_id',
        'fasilitas_id' => 'required|exists:fasilitas_umum,fasilitas_id',
        'tanggal_mulai' => 'required|date',
        'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        'tujuan' => 'required|string',
        'total_biaya' => 'nullable|numeric',
        'status' => 'nullable|in:pending,disetujui,ditolak',
    ]);

    // Simpan file bukti pembayaran jika ada
    if ($request->hasFile('bukti_pembayaran')) {
        // Hapus file lama jika ada
        if ($item->bukti_pembayaran) {
            Storage::disk('public')->delete($item->bukti_pembayaran);
        }
        // Simpan file baru
        $validated['bukti_pembayaran'] = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
    }

    // Update data peminjaman fasilitas
    $item->update($validated);

    // Simpan file media lainnya jika ada
    if ($request->hasFile('files')) {
        foreach ($request->file('files') as $file) {
            $filename = time() . '_' . $file->getClientOriginalName();
            $mime = $file->getMimeType();

            // Tempat penyimpanan file
            $file->move(public_path('uploads/media'), $filename);

            // Simpan informasi file ke tabel media
            DB::table('media')->insert([
                'ref_table' => 'peminjaman_fasilitas',
                'ref_id' => $item->pinjam_id,  // Menghubungkan dengan ID peminjaman
                'file_name' => $filename,
                'mime_type' => $mime,
                'caption' => null,  // Bisa ditambahkan caption jika diperlukan
                'sort_order' => 0,  // Default urutan (opsional)
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    // Redirect ke halaman index setelah update berhasil
    return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman fasilitas berhasil diperbarui!');
}

    public function destroy($id)
    {
        $item = PeminjamanFasilitas::findOrFail($id);
        if ($item->bukti_pembayaran) {
            Storage::disk('public')->delete($item->bukti_pembayaran);
        }
        $item->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman fasilitas berhasil dihapus.');
    }
 public function show($id)
{
    // Ambil data peminjaman berdasarkan ID beserta relasi warga dan fasilitas
    $item = PeminjamanFasilitas::with(['warga', 'fasilitas'])->findOrFail($id);

    // Ambil semua media yang terkait dengan peminjaman ini
    $media = DB::table('media')
        ->where('ref_table', 'peminjaman_fasilitas')
        ->where('ref_id', $id)
        ->get();

    // Mengembalikan view dengan data peminjaman dan media terkait
    return view('pages.peminjaman.show', compact('item', 'media'));
}

}
