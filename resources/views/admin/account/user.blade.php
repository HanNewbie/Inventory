@extends('layouts.admin')

@section('content')
<main class="p-6 bg-gray-50 min-h-screen flex-1" 
      x-data="{ openAdd: false, openEdit: false, editData: {} }">

  <div class="flex justify-between items-center mb-6">
    <h3 class="text-2xl font-semibold text-gray-800">👥 Daftar Pengguna</h3>
    <form action="" method="GET">
      <input 
        type="text" 
        name="search" 
        value="{{ request('search') }}"
        placeholder="Cari username..." 
        class="border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none px-4 py-2 rounded-lg w-72 transition-all"
      >
    </form>
  </div>

  <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
    <div class="flex justify-between items-center px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-blue-600 to-blue-500">
      <h4 class="text-lg font-semibold text-white">Data Pengguna</h4>
      <button 
        @click="openAdd = true"
        class="bg-white text-blue-600 hover:bg-blue-100 font-semibold px-4 py-2 rounded-lg shadow-sm transition-all">
        + Tambah Pengguna
      </button>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
      <table class="w-full border-collapse text-left">
        <thead>
          <tr class="bg-blue-100 text-gray-800">
            <th class="p-4 text-sm font-semibold">No</th>
            <th class="p-4 text-sm font-semibold">ID</th>
            <th class="p-4 text-sm font-semibold">Nama Wisata</th>
            <th class="p-4 text-sm font-semibold">Username</th>
            <th class="p-4 text-sm font-semibold">Role</th>
            <th class="p-4 text-sm font-semibold">Activated At</th>
            <th class="p-4 text-sm font-semibold text-center">Aksi</th>
          </tr>
        </thead>

        <tbody class="text-gray-700">
          @php
            $users = [
              ['id' => 1, 'nama_wisata' => 'Menara Teratai', 'username' => 'menara_user', 'role' => 'User', 'created_at' => now()],
              ['id' => 2, 'nama_wisata' => 'Kolam Retensi', 'username' => 'kolam_user', 'role' => 'User', 'created_at' => now()],
              ['id' => 3, 'nama_wisata' => 'Madhang Maning Park', 'username' => 'mmp_user', 'role' => 'Admin', 'created_at' => now()],
            ];
          @endphp

          @foreach ($users as $row)
          <tr class="@if($loop->even) bg-gray-50 @else bg-white @endif border-b border-gray-100 hover:bg-blue-50 transition-colors">
            <td class="p-4 font-semibold text-gray-700">{{ $loop->iteration }}</td>
            <td class="p-4">{{ $row['id'] }}</td>
            <td class="p-4">{{ $row['nama_wisata'] }}</td>
            <td class="p-4">{{ $row['username'] }}</td>
            <td class="p-4">{{ $row['role'] }}</td>
            <td class="p-4">{{ \Carbon\Carbon::parse($row['created_at'])->format('d/m/Y') }}</td>
            <td class="p-4 text-center flex justify-center gap-2">
              <!-- Button Edit -->
              <button 
                @click="openEdit = true; editData = {{ json_encode($row) }}"
                class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg text-sm font-medium shadow-sm transition">
                Edit
              </button>

              <!-- Button Hapus -->
              <form id="delete-form-{{ $row['id'] }}" method="POST">
                @csrf
                @method('DELETE')
                <button 
                  type="button"
                  class="delete-button bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm font-medium shadow-sm transition"
                  data-id="{{ $row['id'] }}">
                  Hapus
                </button>
              </form>
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
         class="bg-white rounded-xl shadow-xl w-full max-w-lg p-6">
      <h2 class="text-xl font-semibold mb-4 text-gray-800">Tambah Pengguna</h2>
      <form>
        <div class="space-y-4">
          <div>
            <label class="block text-sm text-gray-600 mb-1">Nama Wisata</label>
            <input type="text" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 outline-none" placeholder="Masukkan nama wisata">
          </div>
          <div>
            <label class="block text-sm text-gray-600 mb-1">Username</label>
            <input type="text" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 outline-none" placeholder="Masukkan username">
          </div>
          <div>
            <label class="block text-sm text-gray-600 mb-1">Password</label>
            <input type="password" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 outline-none" placeholder="Masukkan password">
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
         class="bg-white rounded-xl shadow-xl w-full max-w-lg p-6">
      <h2 class="text-xl font-semibold mb-4 text-gray-800">Edit Pengguna</h2>
      <form>
        <div class="space-y-4">
          <div>
            <label class="block text-sm text-gray-600 mb-1">Nama Wisata</label>
            <input type="text" x-model="editData.nama_wisata" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 outline-none">
          </div>
          <div>
            <label class="block text-sm text-gray-600 mb-1">Username</label>
            <input type="text" x-model="editData.username" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 outline-none">
          </div>
          <div>
            <label class="block text-sm text-gray-600 mb-1">Password (opsional)</label>
            <input type="password" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 outline-none" placeholder="Kosongkan jika tidak ingin mengubah">
          </div>
        </div>
        <div class="mt-6 flex justify-end gap-3">
          <button type="button" @click="openEdit = false" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 transition">Batal</button>
          <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-500 transition">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-button');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const rowID = this.getAttribute('data-id');

                Swal.fire({
                    title: "Yakin ingin dihapus?",
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, Hapus!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`delete-form-${rowID}`).submit();
                    }
                });
            });
        });
    });

    // Pesan success/error dari session
    window.addEventListener('pageshow', function () {
        @if(session('error'))
        Swal.fire({
            title: "Gagal!",
            text: @json(session('error')),
            icon: "error",
            confirmButtonColor: "#d33"
        });
        @endif

        @if(session('success'))
        Swal.fire({
            title: "Berhasil!",
            text: @json(session('success')),
            icon: "success",
            confirmButtonColor: "#3085d6"
        });
        @endif
    });
  </script>
</main>
@endsection
