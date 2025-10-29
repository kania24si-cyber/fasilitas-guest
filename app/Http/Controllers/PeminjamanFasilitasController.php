<?php

namespace App\Http\Controllers;
use App\Models\PeminjamanFasilitas;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PeminjamanFasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peminjaman = PeminjamanFasilitas::with('warga')->get();
        return view('guest.peminjaman.index', compact('peminjaman'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $warga = Warga::all();
        return view('guest.peminjaman.create', compact('warga'));  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'warga_id' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'tujuan' => 'required',
            'total_biaya' => 'nullable|numeric',
            'bukti_pembayaran' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('bukti_bayar')) {
            $validated['bayar'] = $request->file('bukti_bayar')->store('bukti_pembayaran', 'public');
        }

        PeminjamanFasilitas::create($validated);
        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman fasilitas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $peminjaman = PeminjamanFasilitas::findOrFail($id);
        $warga = Warga::all();
        return view('guest.peminjaman.edit', compact('peminjaman', 'warga'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $peminjaman = PeminjamanFasilitas::findOrFail($id);
        $validated = $request->validate([
            'warga_id' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'tujuan' => 'required',
            'total_biaya' => 'nullable|numeric',
            'bukti_pembayaran' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('bukti_bayar')) {
            if ($peminjaman->bukti_bayar) {
                Storage::disk('public')->delete($peminjaman->bukti_bayar);
            }
            $validated['bukti_bayar'] = $request->file('bukti_bayar')->store('bukti_bayar', 'public');
        }

        $peminjaman->update($validated);
        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman fasilitas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $peminjaman = PeminjamanFasilitas::findOrFail($id);
        if ($peminjaman->bukti_bayar) {
            Storage::disk('public')->delete($peminjaman->bukti_bayar);
        }
        $peminjaman->delete();
        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman fasilitas berhasil dihapus.');
    }
}
