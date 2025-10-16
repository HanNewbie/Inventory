@extends('layouts.admin')

@section('content')
<main class="p-6 bg-gray-50 min-h-screen flex-1" 
      x-data="{ openAdd: false, openEdit: false, editData: {} }">

  <div class="flex justify-between items-center mb-6">
    <h3 class="text-2xl font-semibold text-gray-800">📦 Stok Barang</h3>
    <form action="" method="GET">
      <input 
        type="text" 
        name="search" 
        value="{{ request('search') }}"
        placeholder="Cari barang..." 
        class="border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none px-4 py-2 rounded-lg w-72 transition-all"
      >
    </form>
  </div>

  <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
    <div class="flex justify-between items-center px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-blue-600 to-blue-500">
      <h4 class="text-lg font-semibold text-white">Daftar Stok Barang</h4>
      <button 
        @click="openAdd = true"
        class="bg-white text-blue-600 hover:bg-blue-100 font-semibold px-4 py-2 rounded-lg shadow-sm transition-all">
        + Tambah Stok Barang
      </button>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
      <table class="w-full border-collapse text-left">
        <thead>
          <tr class="bg-blue-100 text-gray-800">
            <th class="p-4 text-sm font-semibold">No</th>
            <th class="p-4 text-sm font-semibold">Nama Barang</th>
            <th class="p-4 text-sm font-semibold">Jumlah</th>
            <th class="p-4 text-sm font-semibold">Deskripsi</th>
            <th class="p-4 text-sm font-semibold text-center">Aksi</th>
          </tr>
        </thead>

        <tbody class="text-gray-700">
          @php
            $data = [
              ['id' => 1, 'nama' => 'Kamera DSLR Canon EOS 90D', 'jumlah' => '12 Unit', 'deskripsi' => 'Kamera profesional untuk dokumentasi event'],
              ['id' => 2, 'nama' => 'Drone DJI Mavic Air 2', 'jumlah' => '8 Unit', 'deskripsi' => 'Drone untuk pengambilan video udara'],
              ['id' => 3, 'nama' => 'Laptop Asus ROG Zephyrus', 'jumlah' => '6 Unit', 'deskripsi' => 'Laptop performa tinggi untuk desain grafis dan editing'],
              ['id' => 4, 'nama' => 'Tripod Stand Kamera', 'jumlah' => '20 Unit', 'deskripsi' => 'Aksesori untuk penyangga kamera saat pemotretan'],
              ['id' => 5, 'nama' => 'Speaker Portable JBL', 'jumlah' => '15 Unit', 'deskripsi' => 'Speaker nirkabel untuk keperluan acara outdoor'],
            ];
          @endphp

          @foreach ($data as $row)
          <tr class="@if($loop->even) bg-gray-50 @else bg-white @endif border-b border-gray-100 hover:bg-blue-50 transition-colors">
            <td class="p-4 font-semibold text-gray-700">{{ $row['id'] }}</td>
            <td class="p-4">{{ $row['nama'] }}</td>
            <td class="p-4">{{ $row['jumlah'] }}</td>
            <td class="p-4">{{ $row['deskripsi'] }}</td>
            <td class="p-4 text-center">
              <button 
                @click="openEdit = true; editData = {{ json_encode($row) }}"
                class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-sm font-medium shadow-sm transition">
                Edit
              </button>
              <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm font-medium shadow-sm transition">
                Hapus
              </button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal Tambah -->
  <div x-show="openAdd"
       x-transition.opacity
       class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50">
    <div @click.away="openAdd = false"
         class="bg-white rounded-xl shadow-xl w-full max-w-lg p-6 transform transition-all scale-100">
      <h2 class="text-xl font-semibold mb-4 text-gray-800">Tambah Stok Barang</h2>
      <form>
        <div class="space-y-4">
          <div>
            <label class="block text-sm text-gray-600 mb-1">Nama Barang</label>
            <input type="text" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 outline-none">
          </div>
          <div>
            <label class="block text-sm text-gray-600 mb-1">Jumlah</label>
            <input type="number" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 outline-none">
          </div>
          <div>
            <label class="block text-sm text-gray-600 mb-1">Deskripsi</label>
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

  <!-- Modal Edit -->
  <div x-show="openEdit"
       x-transition.opacity
       class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50">
    <div @click.away="openEdit = false"
         class="bg-white rounded-xl shadow-xl w-full max-w-lg p-6 transform transition-all scale-100">
      <h2 class="text-xl font-semibold mb-4 text-gray-800">Edit Barang</h2>
      <form>
        <div class="space-y-4">
          <div>
            <label class="block text-sm text-gray-600 mb-1">Nama Barang</label>
            <input type="text" x-model="editData.nama" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 outline-none">
          </div>
          <div>
            <label class="block text-sm text-gray-600 mb-1">Jumlah</label>
            <input type="text" x-model="editData.jumlah" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 outline-none">
          </div>
          <div>
            <label class="block text-sm text-gray-600 mb-1">Deskripsi</label>
            <textarea x-model="editData.deskripsi" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 outline-none"></textarea>
          </div>
        </div>
        <div class="mt-6 flex justify-end gap-3">
          <button type="button" @click="openEdit = false" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 transition">Batal</button>
          <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-500 transition">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</main>
@endsection
