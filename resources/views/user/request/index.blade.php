@extends('layouts.user')

@section('content')
<main class="p-6 bg-gray-50 min-h-screen flex-1">

  <div class="flex justify-between items-center mb-6">
    <h3 class="text-2xl font-semibold text-gray-800">📝 Riwayat Permintaan</h3>
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
      <h4 class="text-lg font-semibold text-white">Riwayat Permintaan Barang BLUD</h4>
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
            <th class="p-4 text-sm font-semibold text-center">Tanggal</th>
          </tr>
        </thead>

        <tbody class="text-gray-700">
          @php
            $data = [
              ['id' => 1, 'nama' => 'Kamera DSLR Canon EOS 90D', 'jumlah' => '5 Unit', 'deskripsi' => 'kamera keren','tanggal' => '17 Oktober 2025'],
              ];
          @endphp

          @foreach ($data as $row)
          <tr class="@if($loop->even) bg-gray-50 @else bg-white @endif border-b border-gray-100 hover:bg-blue-50 transition-colors">
            <td class="p-4 font-semibold text-gray-700">{{ $row['id'] }}</td>
            <td class="p-4">{{ $row['nama'] }}</td>
            <td class="p-4">{{ $row['jumlah'] }}</td>
            <td class="p-4">{{ $row['deskripsi'] }}</td>
            <td class="p-4">{{ $row['tanggal'] }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

</main>
@endsection
