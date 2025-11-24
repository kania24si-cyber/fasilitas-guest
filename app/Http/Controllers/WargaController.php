<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    public function index(Request $request)
    {
        $filterable = ['jenis_kelamin', 'agama'];
        $searchable = ['nama', 'no_ktp', 'pekerjaan', 'email', 'telp'];

        $data = Warga::filter($request, $filterable)
            ->search($request, $searchable)
            ->orderBy('warga_id', 'DESC')
            ->paginate(9)
            ->withQueryString();

        return view('pages.warga.index', compact('data'));
    }

    public function create()
    {
        return view('pages.warga.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_ktp' => 'required|unique:warga,no_ktp',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'nullable|string',
            'pekerjaan' => 'nullable|string',
            'telp' => 'nullable',
            'email' => 'required|email|unique:warga,email',
        ]);

        Warga::create($validated);

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $item = Warga::findOrFail($id);
        return view('pages.warga.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = Warga::findOrFail($id);

        $validated = $request->validate([
            'no_ktp' => 'required|unique:warga,no_ktp,' . $id . ',warga_id',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'nullable|string',
            'pekerjaan' => 'nullable|string',
            'telp' => 'nullable',
            'email' => 'required|email|unique:warga,email,' . $id . ',warga_id',
        ]);

        $item->update($validated);

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Warga::findOrFail($id)->delete();
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus.');
    }
}
