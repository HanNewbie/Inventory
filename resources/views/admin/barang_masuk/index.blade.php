@extends('layouts.admin')

@section('content')
<main class="p-6 bg-gray-50 min-h-screen flex-1" 
      x-data="{ openAdd: false, openEdit: false, editData: {} }">

  <div class="flex justify-between items-center mb-6">
    <h3 class="text-2xl font-semibold text-gray-800">📥 Barang Masuk</h3>
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
    <!-- Header Card -->
    <div class="flex justify-between items-center px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-blue-600 to-blue-500">
      <h4 class="text-lg font-semibold text-white">📥 Daftar Barang Masuk</h4>
      <button 
        @click="openAdd = true"
        class="bg-white text-blue-600 hover:bg-blue-100 font-semibold px-4 py-2 rounded-lg shadow-sm transition-all">
        + Tambah Barang Masuk
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
            <th class="p-4 text-sm font-semibold">Deskripsi</th>
            <th class="p-4 text-sm font-semibold text-center">Aksi</th>
          </tr>
        </thead>

        <tbody class="text-gray-700">
          @forelse ($barangMasuk as $bm)
          <tr class="border-b border-gray-100 hover:bg-blue-50 transition">
            <td class="p-4 font-semibold text-gray-700">{{ $loop->iteration}}</td>
            <td class="p-4">
                {{ \Carbon\Carbon::parse($bm->tanggal_masuk)->format('d/m/Y') }}
            </td></td>
            <td class="p-4">{{ $bm->barang->nama_barang}}</td>
            <td class="p-4">{{ $bm->jumlah_masuk}}</td>
            <td class="p-4">{{ $bm->deskripsi}}</td>
            <td class="p-4 text-center">
            <button 
              @click="
                  openEdit = true; 
                  editData = {
                    id: {{ $bm->id }},
                    barang_id: {{ $bm->barang_id }},
                    tanggal_masuk: '{{ $bm->tanggal_masuk }}',
                    jumlah_masuk: {{ $bm->jumlah_masuk }},
                    deskripsi: '{{ $bm->deskripsi }}',
                    nama_barang: '{{ $bm->barang->nama_barang }}'
                  }
                "
              class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-sm font-medium shadow-sm transition">
              Edit
            </button>
            <form id="delete-form-{{$bm->id}}" method="POST" action="{{route('barang_masuk.destroy', $bm->id)}}" class="inline">
              @csrf
              @method('DELETE')
              <button type="button" data-id="{{$bm->id}}"class="delete-button bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm font-medium shadow-sm transition">
                Hapus
              </button>
            </form>
            </td>
          </tr>
          @empty
            <tr>
              <td colspan="5" class="text-center p-4 text-gray-500">Data barang belum tersedia.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <div x-show="openAdd"
       x-transition.opacity
       class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50">
    <div @click.away="openAdd = false"
         class="bg-white rounded-xl shadow-xl w-full max-w-lg p-6 transform transition-all scale-100">
      <h2 class="text-xl font-semibold mb-4 text-gray-800">Tambah Barang Masuk</h2>
      <form action="{{ route('barang_masuk.store') }}" method="POST">
        @csrf
        <div class="space-y-4">
          <div>
            <label class="block text-sm text-gray-600 mb-1">Tanggal</label>
            <input type="date" name="tanggal_masuk" required
                  class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 outline-none">
          </div>

          <div>
            <label class="block text-sm text-gray-600 mb-1">Nama Barang</label>
            <select name="barang_id" required
                    class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 outline-none">
              <option value="">-- Pilih Barang --</option>
              @foreach ($stoks as $st)
                <option value="{{ $st->id }}">{{ $st->nama_barang }}</option>
              @endforeach
            </select>
          </div>

          <div>
            <label class="block text-sm text-gray-600 mb-1">Jumlah</label>
            <input type="number" name="jumlah_masuk" min="1" required
                  class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 outline-none">
          </div>

          <div>
            <label class="block text-sm text-gray-600 mb-1">Deskripsi</label>
            <textarea name="deskripsi"
                      class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 outline-none"></textarea>
          </div>
        </div>

        <div class="mt-6 flex justify-end gap-3">
          <button type="button" @click="openAdd = false"
                  class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 transition">Batal</button>
          <button type="submit"
                  class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-500 transition">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <div x-show="openEdit"
     x-transition.opacity
     class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50">
  <div @click.away="openEdit = false"
       class="bg-white rounded-xl shadow-xl w-full max-w-lg p-6 transform transition-all scale-100">
    
    <h2 class="text-xl font-semibold mb-4 text-gray-800">Edit Barang Masuk</h2>

    <form :action="`/admin/barang_masuk/${editData.id}`" method="POST">
      @csrf
      @method('PUT')
      <div class="space-y-4">
        <div>
          <label class="block text-sm text-gray-600 mb-1">Tanggal</label>
          <input type="date" name="tanggal_masuk" 
                 x-model="editData.tanggal_masuk"
                 required
                 class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 outline-none">
        </div>
        <div>
        <div>
          <label class="block text-sm text-gray-600 mb-1">Nama Barang</label>
          <!-- tampilkan nama barang (readonly, bukan ID) -->
          <input 
              type="text" 
              :value="editData.nama_barang" 
              readonly
              class="w-full border rounded-lg px-3 py-2 bg-gray-100 text-gray-700 outline-none"
          >
          <!-- kirim ID barang secara tersembunyi -->
          <input 
              type="hidden" 
              name="barang_id" 
              :value="editData.barang_id"
          >
        </div>
        <div>
          <label class="block text-sm text-gray-600 mb-1">Jumlah</label>
          <input type="number" name="jumlah_masuk" min="1"
                 x-model="editData.jumlah_masuk"
                 required
                 class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 outline-none">
        </div>
        <div>
          <label class="block text-sm text-gray-600 mb-1">Deskripsi</label>
          <textarea name="deskripsi" 
                    x-model="editData.deskripsi"
                    class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 outline-none"></textarea>
        </div>
      </div>
      <div class="mt-6 flex justify-end gap-3">
        <button type="button" @click="openEdit = false"
                class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 transition">
          Batal
        </button>
        <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-500 transition">
          Simpan Perubahan
        </button>
      </div>
    </form>
  </div>
</div>

</main>
<script>
  document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.delete-button');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const adminId = this.getAttribute('data-id');

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
                            document.getElementById(`delete-form-${adminId}`).submit();
                        }
                    });
                });
            });
        });

        window.addEventListener('pageshow', function (event) {
            if (event.persisted || window.performance.getEntriesByType("navigation")[0]?.type === "back_forward") {
                return;
            }

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

@endsection
