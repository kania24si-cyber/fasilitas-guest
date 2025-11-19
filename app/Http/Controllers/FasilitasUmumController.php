<?php

namespace App\Http\Controllers;

use App\Models\FasilitasUmum;
use Illuminate\Http\Request;

class FasilitasUmumController extends Controller
{
    public function index()
    {
        $data = FasilitasUmum::all();
        return view('pages.fasilitas.index', compact('data'));
    }

    public function create()
    {
        return view('pages.fasilitas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'jenis' => 'required',
            'alamat' => 'required',
            'kapasitas' => 'nullable|integer',
            'media' => 'image|mimes:jpg,png,jpeg|max:2048'
        ]);

        if ($request->hasFile('media')) {
            $validated['media'] = $request->file('media')->store('fasilitas', 'public');
        }

        FasilitasUmum::create($validated);

        return redirect()->route('fasilitas.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $item = FasilitasUmum::findOrFail($id);
        return view('pages.fasilitas.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = FasilitasUmum::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required',
            'jenis' => 'required',
            'alamat' => 'required',
            'kapasitas' => 'nullable|integer',
            'media' => 'image|mimes:jpg,png,jpeg|max:2048'
        ]);

        if ($request->hasFile('media')) {
            $validated['media'] = $request->file('media')->store('fasilitas', 'public');
        }

        $item->update($validated);

        return redirect()->route('fasilitas.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $item = FasilitasUmum::findOrFail($id);
        $item->delete();
        return back()->with('success', 'Data berhasil dihapus!');
    }
}
