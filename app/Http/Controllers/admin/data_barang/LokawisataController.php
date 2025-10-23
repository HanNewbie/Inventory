<?php

namespace App\Http\Controllers\admin\data_barang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lokawisata;

class LokawisataController extends Controller
{
    public function index() {
        $lokawisatas = Lokawisata::all();
        return view('admin.data_barang.index', compact('lokawisatas'));
    }

    public function store(Request $request) {
        $request->validate([
            'nama_wisata' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);
        Lokawisata::create($request->all());
        return redirect()->route('lokawisata.index')->with('success', 'Lokawisata berhasil ditambahkan!');
    }

    public function update(Request $request, $id) {
        $lok = Lokawisata::findOrFail($id);
        $lok->update($request->all());
        return redirect()->route('lokawisata.index')->with('success', 'Lokawisata berhasil diperbarui!');
    }

    public function destroy($id) {
        Lokawisata::destroy($id);
        return redirect()->route('lokawisata.index')->with('success', 'Lokawisata berhasil dihapus!');
    }
}
