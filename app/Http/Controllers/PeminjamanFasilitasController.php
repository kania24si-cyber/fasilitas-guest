<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanFasilitas;
use App\Models\Warga;
use App\Models\FasilitasUmum;
use Illuminate\Http\Request;
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
            'bukti_pembayaran' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('bukti_pembayaran')) {
            $validated['bukti_pembayaran'] = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
        }

        PeminjamanFasilitas::create($validated);

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman fasilitas berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $item = PeminjamanFasilitas::findOrFail($id);
        $warga = Warga::all();
        $fasilitas = FasilitasUmum::all();
        return view('pages.peminjaman.edit', compact('item', 'warga', 'fasilitas'));
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
            'total_biaya' => 'nullable|numeric',
            'bukti_pembayaran' => 'nullable|image|max:2048',
            'status' => 'nullable|in:pending,disetujui,ditolak'
        ]);

        if ($request->hasFile('bukti_pembayaran')) {
            if ($item->bukti_pembayaran) {
                Storage::disk('public')->delete($item->bukti_pembayaran);
            }
            $validated['bukti_pembayaran'] = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
        }

        $item->update($validated);

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman fasilitas berhasil diperbarui.');
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
}
