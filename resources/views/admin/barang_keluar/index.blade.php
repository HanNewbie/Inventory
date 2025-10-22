@extends('layouts.admin')

@section('content')
<main class="p-6 bg-gray-50 min-h-screen flex-1"
      x-data="{ openAdd: false }">

  <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
    <div class="flex justify-between items-center px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-blue-600 to-blue-500">
      <h4 class="text-lg font-semibold text-white">📤 Daftar Barang Keluar</h4>
      <button 
        @click="openAdd = true"
        class="bg-white text-blue-600 hover:bg-blue-100 font-semibold px-4 py-2 rounded-lg shadow-sm transition-all">
        + Tambah Barang Keluar
      </button>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full border-collapse text-left">
        <thead>
          <tr class="bg-blue-100 text-gray-800">
            <th class="p-4 text-sm font-semibold">No</th>
            <th class="p-4 text-sm font-semibold">Tanggal</th>
            <th class="p-4 text-sm font-semibold">Nama Barang</th>
            <th class="p-4 text-sm font-semibold">Jumlah</th>
            <th class="p-4 text-sm font-semibold">Lokawisata</th>
            <th class="p-4 text-sm font-semibold">Keterangan</th>
          </tr>
        </thead>

        <tbody class="text-gray-700">
          @php
            $barangKeluar = [
              ['no' => 1, 'tanggal' => '2025-10-17', 'nama' => 'Lap Gading', 'jumlah' => '5', 'lokawisata' => 'Madhang Maning Park', 'keterangan' => 'Kebutuhan pembersihan area'],
              ['no' => 2, 'tanggal' => '2025-10-17', 'nama' => 'Tali Rafia', 'jumlah' => '2', 'lokawisata' => 'Kolam Retensi', 'keterangan' => 'Dekorasi event'],
              ['no' => 3, 'tanggal' => '2025-10-18', 'nama' => 'Sapu lidi tongkat', 'jumlah' => '3', 'lokawisata' => 'Menara Teratai', 'keterangan' => 'Perawatan taman'],
              ['no' => 4, 'tanggal' => '2025-10-18', 'nama' => 'Cikrak Plastik', 'jumlah' => '2', 'lokawisata' => 'Madhang Maning Park', 'keterangan' => 'Penggunaan harian petugas'],
              ['no' => 5, 'tanggal' => '2025-10-18', 'nama' => 'Pembersih Kaca', 'jumlah' => '4', 'lokawisata' => 'Kolam Retensi', 'keterangan' => 'Pembersihan gedung'],
            ];

            $lokawisata = ['Madhang Maning Park', 'Kolam Retensi', 'Menara Teratai'];
          @endphp

          @foreach ($barangKeluar as $row)
          <tr class="@if($loop->even) bg-gray-50 @else bg-white @endif border-b border-gray-100 hover:bg-blue-50 transition">
            <td class="p-4 font-semibold text-gray-700">{{ $row['no'] }}</td>
            <td class="p-4">{{ $row['tanggal'] }}</td>
            <td class="p-4">{{ $row['nama'] }}</td>
            <td class="p-4">{{ $row['jumlah'] }}</td>
            <td class="p-4">{{ $row['lokawisata'] }}</td>
            <td class="p-4">{{ $row['keterangan'] }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <div x-show="openAdd"
       x-transition.opacity
       class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50">
    <div @click.away="openAdd = false"
         class="bg-white rounded-xl shadow-xl w-full max-w-lg p-6 transform transition-all scale-100">
      <h2 class="text-xl font-semibold mb-4 text-gray-800">Tambah Barang Keluar</h2>
      <form>
        <div class="space-y-4">
          <div>
            <label class="block text-sm text-gray-600 mb-1">Tanggal</label>
            <input type="date" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 outline-none">
          </div>

          <div>
            <label class="block text-sm text-gray-600 mb-1">Nama Lokawisata</label>
            <select class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 outline-none">
              <option value="">-- Pilih Lokawisata --</option>
              @foreach ($lokawisata as $lok)
                <option>{{ $lok }}</option>
              @endforeach
            </select>
          </div>

          <div>
            <label class="block text-sm text-gray-600 mb-1">Nama Barang</label>
            <select class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 outline-none">
              <option value="">-- Pilih Barang --</option>
              <option>Lap Gading</option>
              <option>Tali Rafia</option>
              <option>Sapu lidi tongkat</option>
              <option>Cikrak Plastik</option>
              <option>Pembersih Kaca</option>
            </select>
          </div>

          <div>
            <label class="block text-sm text-gray-600 mb-1">Jumlah</label>
            <input type="number" min="1" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 outline-none">
          </div>

          <div>
            <label class="block text-sm text-gray-600 mb-1">Keterangan</label>
            <textarea class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 outline-none"></textarea>
          </div>
        </div>

        <div class="mt-6 flex justify-end gap-3">
          <button type="button" @click="openAdd = false" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 transition">Batal</button>
          <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-500 transition">Simpan</button>
        </div>
      </form>
    </div>
  </div>

</main>
@endsection
