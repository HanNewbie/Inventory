<?php

namespace App\Http\Controllers\admin\barang_masuk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang_masuk;
use App\Models\Barang;

class InboundController extends Controller
{
    public function index(Request $request)
    {
        $query = Barang_masuk::with('barang');

        if($request->filled('search')){ 
            $query->where('nama_barang', 'like' . $request->search . '%'); 
        }

        $barangMasuk = $query->orderBy('id', 'desc')->get();

        $stoks = Barang::orderBy('nama_barang')->get();

        return view('admin.barang_masuk.index', compact('barangMasuk', 'stoks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'jumlah_masuk' => 'required|integer|min:1',
            'tanggal_masuk' => 'required|date',
            'deskripsi' => 'nullable|string',
        ]);

        Barang_masuk::create([
            'barang_id' => $request->barang_id,
            'jumlah_masuk' => $request->jumlah_masuk,
            'tanggal_masuk' => $request->tanggal_masuk,
            'deskripsi' => $request->deskripsi,
        ]);

        $barang = Barang::find($request->barang_id);
        if ($barang) {
            $barang->jumlah_stok += $request->jumlah_masuk;
            $barang->save();
        }

        return redirect()->route('barang_masuk.index')->with('success', 'Barang masuk berhasil ditambahkan dan stok diperbarui!');
    }


    public function destroy($id)
    {
        $barang = Barang_masuk::findOrFail($id);
        $barang->delete();

        return redirect()->route('barang_masuk.index')->with('success', 'Data berhasil dihapus');
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'tanggal_masuk' => 'required|date',
            'jumlah_masuk' => 'required|integer|min:1',
            'deskripsi' => 'nullable|string',
        ]);

        // Ambil data barang masuk
        $barangMasuk = Barang_masuk::findOrFail($id);
        
        // Ambil stok barang terkait
        $barang = Barang::findOrFail($request->barang_id);

        // Kembalikan stok lama sebelum update
        $barang->jumlah_stok -= $barangMasuk->jumlah_masuk;

        // Update data barang masuk
        $barangMasuk->update([
            'barang_id' => $request->barang_id,
            'tanggal_masuk' => $request->tanggal_masuk,
            'jumlah_masuk' => $request->jumlah_masuk,
            'deskripsi' => $request->deskripsi,
        ]);

        // Tambahkan stok baru sesuai jumlah masuk terbaru
        $barang->jumlah_stok += $request->jumlah_masuk;
        $barang->save();

        return redirect()->route('barang_masuk.index')->with('success', 'Data barang masuk berhasil diperbarui!');
    }

}
