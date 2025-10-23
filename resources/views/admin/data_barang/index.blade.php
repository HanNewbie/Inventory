@extends('layouts.admin')

@section('content')
<main class="p-6 bg-gray-50 min-h-screen flex-1"
      x-data="{ openAdd: false, openEdit: false, editData: {} }">

  <div class="flex justify-between items-center mb-6">
    <h3 class="text-2xl font-semibold text-gray-800">🏔️ Daftar Lokawisata</h3>
    <button 
      @click="openAdd = true"
      class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-500 transition-all shadow-sm">
      + Tambah Lokawisata
    </button>
  </div>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($lokawisatas as $lok)
      <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-all p-6 flex flex-col justify-between">
        <div>
          <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $lok->nama_lokawisata }}</h2>
          <p class="text-sm text-gray-500 mb-3">
            {{ $lok->deskripsi ?? 'Tidak ada deskripsi.' }}
          </p>
        </div>

        <div class="flex justify-end gap-3 mt-4">
          <button 
            @click="openEdit = true; editData = {{ $lok->toJson() }}"
            class="px-3 py-1.5 bg-yellow-500 text-white rounded-lg hover:bg-yellow-400 transition">
            ✏️ Edit
          </button>
          <form action="{{ route('lokawisata.destroy', $lok->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus lokawisata ini?')">
            @csrf
            @method('DELETE')
            <button class="px-3 py-1.5 bg-red-600 text-white rounded-lg hover:bg-red-500 transition">
              🗑️ Hapus
            </button>
          </form>
        </div>
      </div>
    @empty
      <p class="text-gray-500 text-center col-span-full py-10">Belum ada data lokawisata.</p>
    @endforelse
  </div>

  <!-- Modal Tambah -->
  <div x-show="openAdd"
       x-transition.opacity
       class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div @click.away="openAdd = false"
         class="bg-white rounded-xl shadow-lg w-full max-w-md p-6">
      <h2 class="text-xl font-semibold text-gray-800 mb-4">Tambah Lokawisata</h2>
      <form action="{{ route('lokawisata.store') }}" method="POST">
        @csrf
        <div class="space-y-4">
          <div>
            <label class="block text-sm text-gray-600 mb-1">Nama Lokawisata</label>
            <input type="text" name="nama_wisata" required
                   class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 outline-none">
          </div>

          <div>
            <label class="block text-sm text-gray-600 mb-1">Deskripsi</label>
            <textarea name="deskripsi"
                      class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 outline-none"
                      rows="3"></textarea>
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

  <!-- Modal Edit -->
  <div x-show="openEdit"
       x-transition.opacity
       class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div @click.away="openEdit = false"
         class="bg-white rounded-xl shadow-lg w-full max-w-md p-6">
      <h2 class="text-xl font-semibold text-gray-800 mb-4">Edit Lokawisata</h2>
      <form :action="'/lokawisata/' + editData.id" method="POST">
        @csrf
        @method('PUT')
        <div class="space-y-4">
          <div>
            <label class="block text-sm text-gray-600 mb-1">Nama Lokawisata</label>
            <input type="text" name="nama_wisata" x-model="editData.nama_wisata"
                   required class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 outline-none">
          </div>

          <div>
            <label class="block text-sm text-gray-600 mb-1">Deskripsi</label>
            <textarea name="deskripsi" x-model="editData.deskripsi"
                      class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 outline-none"
                      rows="3"></textarea>
          </div>
        </div>

        <div class="mt-6 flex justify-end gap-3">
          <button type="button" @click="openEdit = false"
                  class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 transition">Batal</button>
          <button type="submit"
                  class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-500 transition">Update</button>
        </div>
      </form>
    </div>
  </div>

</main>
@endsection
