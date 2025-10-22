<?php

namespace App\Http\Controllers\admin\stok_barang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;

class StokBarangController extends Controller
{
    public function index(Request $request){

        $query = Barang::query();

        if($request->filled('search')){
            $query->where('nama_barang', 'like' . $request->search . '%');
        }

        $stoks = $query->orderBy('id', 'desc')->get();

        return view('admin.stok_barang.index', compact('stoks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jumlah_stok' => 'required|integer|min:1',
            'deskripsi' => 'nullable|string',
        ]);

        Barang::create([
            'nama_barang' => $request->nama_barang,
            'jumlah_stok' => $request->jumlah_stok,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('stok_barang.index')->with('success', 'Stok barang berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()->route('stok_barang.index')->with('success', 'Stok barang berhasil dihapus');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
        'nama_barang' => 'required|string|max:255',
        'jumlah_stok' => 'required|integer|min:1',
        'deskripsi' => 'nullable|string',
        ]);

        $stok = Barang::findOrFail($id);
        $stok->update($request->only(['nama_barang', 'jumlah_stok', 'deskripsi']));
        return redirect()->route('stok_barang.index', compact('stok'))->with('success', 'Stok barang berhasil diperbarui');
    }
}