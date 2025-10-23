<?php

namespace App\Http\Controllers\admin\barang_keluar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang_keluar;
use App\Models\Barang;
use App\Models\Lokawisata;

class OutboundController extends Controller
{
    public function index()
    {
        $keluars = Barang_keluar::with('barang')->latest()->get();
        $barangs = Barang::all();
        $wisatas = Lokawisata::all();

        return view('admin.barang_keluar.index', compact('keluars', 'barangs', 'wisatas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'lokawisata_id' => 'required|exists:lokawisata,id',
            'tanggal_keluar' => 'required|date',
            'jumlah_keluar' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        $keluar = Barang_keluar::create([
            'barang_id' => $request->barang_id,
            'lokawisata_id' => $request->lokawisata_id,
            'tanggal_keluar' => $request->tanggal_keluar,
            'jumlah_keluar' => $request->jumlah_keluar,
            'keterangan' => $request->keterangan,
        ]);

        $barang = Barang::find($request->barang_id);
        if ($barang) {
            $barang->jumlah_stok = max(0, $barang->jumlah_stok - $request->jumlah_keluar);
            $barang->save();
        }

        return redirect()->route('barang_keluar.index')->with('success', 'Barang keluar berhasil ditambahkan.');
    }


    public function destroy($id)
    {
        $barangKeluar = BarangKeluar::findOrFail($id);
        $barang = Barang::find($barangKeluar->barang_id);

        if ($barang) {
            $barang->jumlah_stok += $barangKeluar->jumlah_keluar;
            $barang->save();
        }

        $barangKeluar->delete();

        return redirect()->route('barang_keluar.index')->with('success', 'Data barang keluar dihapus dan stok diperbarui.');
    }
}
