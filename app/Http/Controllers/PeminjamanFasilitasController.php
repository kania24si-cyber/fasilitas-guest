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
    $validated = $request->validate([
        'warga_id' => 'required|exists:warga,warga_id',
        'fasilitas_id' => 'required|exists:fasilitas_umum,fasilitas_id',
        'tanggal_mulai' => 'required|date',
        'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        'tujuan' => 'required|string',
        'total_biaya' => 'nullable|numeric',
        'files.*' => 'nullable|mimes:jpg,jpeg,png,pdf,docx,xlsx|max:2048', 
    ]);

    $peminjaman = PeminjamanFasilitas::create($validated);
    if ($request->hasFile('bukti_bayaran')) {

        $path = $request->file('bukti_bayaran')->store('bukti_bayaran', 'public'); 
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
    if ($request->hasFile('files')) {
        foreach ($request->file('files') as $file) {
            $filename = time() . '_' . $file->getClientOriginalName();
            
            $filePath = $file->storeAs('uploads/media', $filename, 'public'); 

            DB::table('media')->insert([
                'ref_table' => 'peminjaman_fasilitas',
                'ref_id' => $peminjaman->pinjam_id,
                'file_name' => basename($filePath),
                'mime_type' => $file->getMimeType(),
                'caption' => null,  
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
        $item = PeminjamanFasilitas::findOrFail($id);

        $warga = Warga::all();
        $fasilitas = FasilitasUmum::all();

        $media = DB::table('media')
            ->where('ref_table', 'peminjaman_fasilitas')
            ->where('ref_id', $id)
            ->get();

        return view('pages.peminjaman.edit', compact('item', 'warga', 'fasilitas', 'media'));
    }

   public function update(Request $request, $id)
{
    $item = PeminjamanFasilitas::findOrFail($id);

    $validated = $request->validate([
        'warga_id' => 'required|exists:warga,warga_id',
        'fasilitas_id' => 'required|exists:fasilitas_umum,fasilitas_id',
        'tanggal_mulai' => 'required|date',
        'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        'tujuan' => 'required|string',
        'total_biaya' => 'nullable', 
        'status' => 'nullable|in:pending,disetujui,lunas,ditolak',
        'files.*' => 'nullable|mimes:jpg,jpeg,png,pdf,docx,xlsx|max:2048',
    ]);

    if ($request->filled('total_biaya')) {
        $validated['total_biaya'] = str_replace('.', '', $request->total_biaya); 
    } else {
        $validated['total_biaya'] = $item->total_biaya; 
    }

    if ($request->hasFile('bukti_pembayaran')) {
        if ($item->bukti_pembayaran) {
            Storage::disk('public')->delete($item->bukti_pembayaran);  // Menghapus file lama jika ada
        }

        $validated['bukti_pembayaran'] = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
    }

    $item->update($validated);

    if ($request->hasFile('files')) {
        foreach ($request->file('files') as $file) {
            $filename = time() . '_' . $file->getClientOriginalName();
            $mime = $file->getMimeType();

            $filePath = $file->storeAs('uploads/media', $filename, 'public');

            DB::table('media')->insert([
                'ref_table' => 'peminjaman_fasilitas',
                'ref_id' => $item->pinjam_id,
                'file_name' => basename($filePath),
                'mime_type' => $mime,
                'caption' => null,
                'sort_order' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

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
        $item = PeminjamanFasilitas::with(['warga', 'fasilitas'])->findOrFail($id);

        $media = DB::table('media')
            ->where('ref_table', 'peminjaman_fasilitas')
            ->where('ref_id', $id)
            ->get();

        $placeholderImage = asset('assets/img/placeholder.jpg'); 

        return view('pages.peminjaman.show', compact('item', 'media', 'placeholderImage'));
    }
}
