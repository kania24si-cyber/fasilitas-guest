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
    $filterable = ['metode']; 
    $searchable = ['tanggal', 'keterangan']; 
    $metodes = ['Transfer Bank', 'Tunai', 'E-wallet', 'Debit']; 

    $data = PembayaranFasilitas::with('peminjaman') 
        ->filter($request, $filterable) 
        ->search($request, $searchable) 
        ->orderBy('bayar_id', 'DESC') 
        ->paginate(10) 
        ->withQueryString(); 

    foreach ($data as $item) {
        $item->media = DB::table('media')
            ->where('ref_table', 'pembayaran_fasilitas')
            ->where('ref_id', $item->bayar_id)
            ->get();
    }

    $peminjaman = PeminjamanFasilitas::all();

   
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
   
    $validated = $request->validate([
        'pinjam_id' => 'required|exists:peminjaman_fasilitas,pinjam_id',
        'tanggal'   => 'required|date',
        'jumlah'    => 'required|numeric',
        'metode'    => 'required|string',
        'keterangan'=> 'nullable|string',
        'files.*'   => 'nullable|mimes:jpg,jpeg,png,pdf,docx,xlsx|max:2048',
    ]);

    $pembayaran = PembayaranFasilitas::create($validated);

    if ($request->hasFile('files')) {
        foreach ($request->file('files') as $file) {
            if ($file->isValid()) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads/media', $filename, 'public');

                DB::table('media')->insert([
                    'ref_table'  => 'pembayaran_fasilitas',
                    'ref_id'     => $pembayaran->bayar_id,
                    'file_name'  => basename($filePath),
                    'mime_type'  => $file->getMimeType(),
                    'caption'    => null,
                    'sort_order' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                  ]);
            }
        }
    }

    return redirect()
        ->route('pembayaran_fasilitas.index')
        ->with('success', 'Pembayaran berhasil disimpan!');
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

    $placeholderImage = asset('assets/img/placeholder.jpg');  

    return view('pages.PembayaranFasilitas.show', compact('pembayaran', 'media', 'placeholderImage'));
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
