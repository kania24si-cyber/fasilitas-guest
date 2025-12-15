<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PembayaranFasilitas;
use App\Models\PeminjamanFasilitas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PembayaranFasilitasController extends Controller
{
     public function index(Request $request)
{
    // Mendefinisikan filterable dan searchable
    $filterable = ['metode']; // Filter berdasarkan metode pembayaran (misalnya, transfer, tunai, e-wallet, dll)
    $searchable = ['tanggal', 'keterangan']; // Mencari berdasarkan tanggal atau keterangan

    // Mengambil data metode pembayaran yang ada untuk filter
    $metodes = ['Transfer Bank', 'Tunai', 'E-wallet', 'Debit']; // Daftar metode pembayaran

    // Mengambil data pembayaran fasilitas dengan filter dan pencarian
    $data = PembayaranFasilitas::with('peminjaman') // Menyertakan relasi peminjaman
        ->filter($request, $filterable) // Menambahkan filter
        ->search($request, $searchable) // Menambahkan pencarian
        ->orderBy('bayar_id', 'DESC') // Mengurutkan berdasarkan ID pembayaran
        ->paginate(10) // Paginate data dengan 10 item per halaman
        ->withQueryString(); // Menjaga query string saat paginasi

    // Mengambil media terkait setiap pembayaran fasilitas
    foreach ($data as $item) {
        $item->media = DB::table('media')
            ->where('ref_table', 'pembayaran_fasilitas')
            ->where('ref_id', $item->bayar_id)
            ->get();
    }

    // Ambil data peminjaman untuk dropdown filter (misalnya untuk memilih jenis fasilitas)
    $peminjaman = PeminjamanFasilitas::all();

    // Mengembalikan view dengan data yang telah diproses
    return view('pages.PembayaranFasilitas.index', compact('data', 'peminjaman', 'metodes'));
}

    public function create()
    {
        // Ambil data peminjaman untuk dipilih
        $peminjaman = PeminjamanFasilitas::all();
        return view('pages.PembayaranFasilitas.create', compact('peminjaman'));
    }

    public function store(Request $request)
    {
        // Validasi data input
        $validated = $request->validate([
            'pinjam_id' => 'required|exists:peminjaman_fasilitas,pinjam_id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric',
            'metode' => 'required|string',
            'keterangan' => 'nullable|string',
            'files.*' => 'nullable|mimes:jpg,jpeg,png,pdf,docx,xlsx|max:2048', // Validasi file
        ]);

        // Simpan data pembayaran fasilitas
        $pembayaran = PembayaranFasilitas::create($validated);

        // Menyimpan resi ke tabel media jika ada file yang di-upload
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                if ($file->isValid()) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $filePath = $file->storeAs('uploads/media', $filename, 'public');

                    DB::table('media')->insert([
                        'ref_table' => 'pembayaran_fasilitas',
                        'ref_id' => $pembayaran->bayar_id,
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

        // Setelah pembayaran berhasil, arahkan ke home jika sudah login
        if (Auth::check()) {  // Hanya periksa apakah sudah login
            return redirect()->route('about')->with('success', 'Pembayaran berhasil disimpan!');
        }

        // Jika pengguna belum login, arahkan ke halaman login
        return redirect()->route('auth.index')->with('error', 'Anda harus login terlebih dahulu!');
    }


    public function edit($id)
    {
        $pembayaran = PembayaranFasilitas::findOrFail($id);
        $peminjaman = PeminjamanFasilitas::all();
        return view('pages.PembayaranFasilitas.edit', compact('pembayaran', 'peminjaman'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'pinjam_id' => 'required|exists:peminjaman_fasilitas,pinjam_id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric',
            'metode' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        $pembayaran = PembayaranFasilitas::findOrFail($id);
        $pembayaran->update($validated);

        // Menyimpan file baru jika ada
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                if ($file->isValid()) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $filePath = $file->storeAs('uploads/media', $filename, 'public');

                    DB::table('media')->insert([
                        'ref_table' => 'pembayaran_fasilitas',
                        'ref_id' => $pembayaran->bayar_id,
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

        return redirect()->route('pembayaran_fasilitas.index')->with('success', 'Pembayaran berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pembayaran = PembayaranFasilitas::findOrFail($id);
        $pembayaran->delete();

        return redirect()->route('pembayaran_fasilitas.index')->with('success', 'Pembayaran berhasil dihapus!');
    }

    public function show($id)
    {
        $pembayaran = PembayaranFasilitas::findOrFail($id);
        $media = DB::table('media')
            ->where('ref_table', 'pembayaran_fasilitas')
            ->where('ref_id', $id)
            ->get();

        return view('pages.PembayaranFasilitas.show', compact('pembayaran', 'media'));
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
