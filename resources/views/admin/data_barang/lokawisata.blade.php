@extends('layouts.admin')

@section('content')

<main class="p-6 bg-gray-50 min-h-screen flex-1">
  <div class="flex justify-between items-center mb-6">
    <h3 class="text-2xl font-semibold text-gray-800">🏔️ Lokawisata</h3>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition-all">
      <h2 class="text-xl font-semibold text-gray-800 mb-2">🌋 Baturaden</h2>
    </div>

    <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition-all">
      <h2 class="text-xl font-semibold text-gray-800 mb-2">🏝️ Telaga Sunyi</h2>
    </div>

    <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition-all">
      <h2 class="text-xl font-semibold text-gray-800 mb-2">🏕️ Curug Gede</h2>
    </div>

    <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition-all">
      <h2 class="text-xl font-semibold text-gray-800 mb-2">🌄 Pancuran Pitu</h2>
    </div>

  </div>

</main>
@endsection
