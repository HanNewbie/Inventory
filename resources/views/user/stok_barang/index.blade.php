@extends('layouts.user')

@section('content')
<main class="p-6 bg-gray-50 min-h-screen flex-1" x-data="{ openReq: false, editData: {} }">

  <div class="flex justify-between items-center mb-6">
    <h3 class="text-2xl font-semibold text-gray-800">📦 Stok Barang BLUD</h3>
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
      <h4 class="text-lg font-semibold text-white">Daftar Stok Barang BLUD</h4>
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
                @click="openReq = true; editData = {{ json_encode($row) }}"
                class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-sm font-medium shadow-sm transition">
                Request
              </button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal -->
  <div 
    x-show="openReq"
    x-cloak
    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50"
  >
    <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative">
      <h2 class="text-xl font-semibold text-gray-800 mb-4">📝 Request Barang</h2>

      <form @submit.prevent="alert('Request terkirim untuk: ' + editData.nama_barang)">
        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-1">Nama Barang</label>
          <input 
            type="text" 
            x-model="editData.nama" 
            readonly
            class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-100 text-gray-700"
          >
        </div>

        <div class="mb-6">
          <label class="block text-gray-700 font-medium mb-1">Jumlah yang di-request</label>
          <input 
            type="number" 
            min="1"
            placeholder="Masukkan jumlah..." 
            class="w-full border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none rounded-lg px-4 py-2"
          >
        </div>

        <div class="flex justify-end gap-3">
          <button 
            type="button"
            @click="openReq = false"
            class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg transition">
            Batal
          </button>

          <button 
            type="button"
            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">
            Kirim
          </button>
        </div>
      </form>
    </div>
  </div>

</main>
@endsection
