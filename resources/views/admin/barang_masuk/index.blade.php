@extends('layouts.admin')

@section('content')
<main class="p-6 bg-gray-50 min-h-screen flex-1" 
      x-data="{ openAdd: false, openEdit: false, editData: {} }">

  <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
    <!-- Header Card -->
    <div class="flex justify-between items-center px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-blue-600 to-blue-500">
      <h4 class="text-lg font-semibold text-white">📥 Daftar Barang Masuk</h4>
      <button 
        @click="openAdd = true"
        class="bg-white text-blue-600 hover:bg-blue-100 font-semibold px-4 py-2 rounded-lg shadow-sm transition-all">
        + Tambah Barang Masuk
      </button>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
      <table class="w-full border-collapse text-left">
        <thead>
          <tr class="bg-blue-100 text-gray-800">
            <th class="p-4 text-sm font-semibold">No</th>
            <th class="p-4 text-sm font-semibold">Tanggal</th>
            <th class="p-4 text-sm font-semibold">Nama Barang</th>
            <th class="p-4 text-sm font-semibold">Jumlah</th>
            <th class="p-4 text-sm font-semibold">Keterangan</th>
            <th class="p-4 text-sm font-semibold text-center">Aksi</th>
          </tr>
        </thead>

        <tbody class="text-gray-700">
          @php
            $barangMasuk = [
              ['no' => 1, 'tanggal' => '2025-10-15', 'nama' => 'Lap Gading', 'jumlah' => '20', 'keterangan' => 'Stok baru dari pengadaan'],
              ['no' => 2, 'tanggal' => '2025-10-16', 'nama' => 'Tali Rafia', 'jumlah' => '10', 'keterangan' => 'Tambahan stok gudang'],
              ['no' => 3, 'tanggal' => '2025-10-16', 'nama' => 'Sapu lidi tongkat', 'jumlah' => '15', 'keterangan' => 'Pengiriman dari vendor'],
              ['no' => 4, 'tanggal' => '2025-10-17', 'nama' => 'Cikrak Plastik', 'jumlah' => '8', 'keterangan' => 'Barang pengganti rusak'],
              ['no' => 5, 'tanggal' => '2025-10-17', 'nama' => 'Pembersih Kaca', 'jumlah' => '12', 'keterangan' => 'Stok kebersihan baru'],
            ];
          @endphp

          @foreach ($barangMasuk as $row)
          <tr class="@if($loop->even) bg-gray-50 @else bg-white @endif border-b border-gray-100 hover:bg-blue-50 transition">
            <td class="p-4 font-semibold text-gray-700">{{ $row['no'] }}</td>
            <td class="p-4">{{ $row['tanggal'] }}</td>
            <td class="p-4">{{ $row['nama'] }}</td>
            <td class="p-4">{{ $row['jumlah'] }}</td>
            <td class="p-4">{{ $row['keterangan'] }}</td>
            <td class="p-4 text-center">
              <button 
                @click="openEdit = true; editData = {{ json_encode($row) }}"
                class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-sm font-medium shadow-sm transition">
                Edit
              </button>
              <button 
                onclick="hapusData('{{ $row['nama'] }}')"
                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm font-medium shadow-sm transition">
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
      <h2 class="text-xl font-semibold mb-4 text-gray-800">Tambah Barang Masuk</h2>
      <form>
        <div class="space-y-4">
          <div>
            <label class="block text-sm text-gray-600 mb-1">Tanggal</label>
            <input type="date" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 outline-none">
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

  <!-- Modal Edit -->
  <div x-show="openEdit"
       x-transition.opacity
       class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50">
    <div @click.away="openEdit = false"
         class="bg-white rounded-xl shadow-xl w-full max-w-lg p-6 transform transition-all scale-100">
      <h2 class="text-xl font-semibold mb-4 text-gray-800">Edit Barang Masuk</h2>
      <form>
        <div class="space-y-4">
          <div>
            <label class="block text-sm text-gray-600 mb-1">Tanggal</label>
            <input type="date" x-model="editData.tanggal" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 outline-none">
          </div>
          <div>
            <label class="block text-sm text-gray-600 mb-1">Nama Barang</label>
            <select x-model="editData.nama" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 outline-none">
              <option>Lap Gading</option>
              <option>Tali Rafia</option>
              <option>Sapu lidi tongkat</option>
              <option>Cikrak Plastik</option>
              <option>Pembersih Kaca</option>
            </select>
          </div>
          <div>
            <label class="block text-sm text-gray-600 mb-1">Jumlah</label>
            <input type="number" x-model="editData.jumlah" min="1" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 outline-none">
          </div>
          <div>
            <label class="block text-sm text-gray-600 mb-1">Keterangan</label>
            <textarea x-model="editData.keterangan" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 outline-none"></textarea>
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

<!-- SweetAlert untuk Hapus -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  function hapusData(nama) {
    Swal.fire({
      title: 'Apakah Anda yakin?',
      text: `Data "${nama}" akan dihapus!`,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, Hapus',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: 'Dihapus!',
          text: `Data "${nama}" berhasil dihapus.`,
          icon: 'success',
          timer: 1500,
          showConfirmButton: false
        });
      }
    });
  }
</script>
@endsection
