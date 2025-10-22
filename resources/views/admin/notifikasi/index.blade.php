@extends('layouts.admin')

@section('content')
<main class="p-6 bg-gray-50 min-h-screen flex-1"
      x-data="{ notifData: [
        {id: 1, tanggal: '2025-10-17', lokawisata: 'Madhang Maning Park', barang: 'Lap Gading', jumlah: '5'},
        {id: 2, tanggal: '2025-10-17', lokawisata: 'Kolam Retensi', barang: 'Tali Rafia', jumlah: '2'},
        {id: 3, tanggal: '2025-10-18', lokawisata: 'Menara Teratai', barang: 'Sapu lidi tongkat', jumlah: '3'},
      ]}">
  
  <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
    <div class="flex justify-between items-center px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-blue-600 to-blue-500">
      <h4 class="text-lg font-semibold text-white">🔔 Notifikasi Permintaan Barang</h4>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full border-collapse text-left">
        <thead>
          <tr class="bg-blue-100 text-gray-800">
            <th class="p-4 text-sm font-semibold">No</th>
            <th class="p-4 text-sm font-semibold">Tanggal</th>
            <th class="p-4 text-sm font-semibold">Lokawisata</th>
            <th class="p-4 text-sm font-semibold">Barang</th>
            <th class="p-4 text-sm font-semibold">Jumlah</th>
            <th class="p-4 text-sm font-semibold text-center">Aksi</th>
          </tr>
        </thead>

        <tbody class="text-gray-700">
          <template x-for="item in notifData" :key="item.id">
            <tr class="border-b border-gray-100 hover:bg-blue-50 transition">
              <td class="p-4 font-semibold text-gray-700" x-text="item.id"></td>
              <td class="p-4" x-text="item.tanggal"></td>
              <td class="p-4" x-text="item.lokawisata"></td>
              <td class="p-4" x-text="item.barang"></td>
              <td class="p-4" x-text="item.jumlah"></td>
              <td class="p-4 text-center flex justify-center gap-2">
                <button 
                        class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg text-sm font-medium shadow-sm transition">
                  Approved
                </button>
                <button
                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm font-medium shadow-sm transition">
                  Rejected
                </button>
              </td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>
  </div>

</main>
@endsection
