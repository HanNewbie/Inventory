@extends('layouts.user')

@section('content')
<main class="p-6 bg-gray-100">
  <h1 class="text-2xl font-bold mb-6">Selamat Datang, {{ auth()->user()->username }}.</h1>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6 max-w-6xl w-full">
    <div class="bg-white p-9 rounded-xl shadow text-center">
      <h2 class="text-lg font-semibold mb-2">Jumlah Barang Masuk</h2>
      <p class="text-3xl font-bold text-blue-600">1,250</p>
    </div>

    <div class="bg-white p-9 rounded-xl shadow text-center">
      <h2 class="text-lg font-semibold mb-2">Barang Masuk Hari Ini</h2>
      <p class="text-3xl font-bold text-green-600">75</p>
    </div>

</main>
@endsection