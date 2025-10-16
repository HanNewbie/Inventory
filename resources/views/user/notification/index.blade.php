@extends('layouts.user')

@section('content')
<main class="p-6 bg-gray-50 min-h-screen flex-1">

  <div class="flex justify-between items-center mb-6">
    <h3 class="text-2xl font-semibold text-gray-800">🔔 Notifikasi</h3>
  </div>

  <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
    <div class="flex justify-between items-center px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-blue-600 to-blue-500">
      <h4 class="text-lg font-semibold text-white">Notifikasi</h4>
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
            <th class="p-4 text-sm font-semibold text-center">Aksi</th>
          </tr>
        </thead>

        <tbody class="text-gray-700">
          @php
            $data = [
              ['id' => 2, 'nama' => 'Drone DJI Mavic Air 2', 'jumlah' => '3 Unit', 'deskripsi' => 'drone canggih','tanggal' => '18 Oktober 2025', 'aksi' => 'Ditolak'],
              ['id' => 3, 'nama' => 'Laptop Asus ROG Zephyrus', 'jumlah' => '2 Unit', 'deskripsi' => 'laptop gaming','tanggal' => '18 Oktober 2025', 'aksi' => 'Disetujui'],
              ['id' => 4, 'nama' => 'Tripod Stand Kamera', 'jumlah' => '10 Unit', 'deskripsi' => 'tripod kuat','tanggal' => '18 Oktober 2025', 'aksi' => 'Ditolak'],
              ['id' => 5, 'nama' => 'Speaker Portable JBL', 'jumlah' => '7 Unit', 'deskripsi' => 'speaker jernih','tanggal' => '18 Oktober 2025', 'aksi' => 'Disetujui'],
              ];
          @endphp

          @foreach ($data as $row)
          <tr class="@if($loop->even) bg-gray-50 @else bg-white @endif border-b border-gray-100 hover:bg-blue-50 transition-colors">
            <td class="p-4 font-semibold text-gray-700">{{ $row['id'] }}</td>
            <td class="p-4">{{ $row['nama'] }}</td>
            <td class="p-4">{{ $row['jumlah'] }}</td>
            <td class="p-4">{{ $row['deskripsi'] }}</td>
            <td class="p-4">{{ $row['tanggal'] }}</td>
            <td class="p-4 text-center">
              @if($row['aksi'] == 'Disetujui')
                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">{{ $row['aksi'] }}</span>
              @elseif($row['aksi'] == 'Ditolak')
                <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium">{{ $row['aksi'] }}</span>
              @endif
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

</main>
@endsection
