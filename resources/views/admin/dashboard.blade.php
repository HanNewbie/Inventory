@extends('layouts.admin')

@section('content')
<main class="p-6 bg-gray-100 min-h-screen">
  <h1 class="text-2xl font-bold mb-6">Selamat Datang, {{ auth()->user()->username }}</h1>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6 max-w-6xl mx-auto">

    <div class="bg-white p-6 rounded-xl shadow text-center">
      <h2 class="text-lg font-semibold mb-2">Total Stok Barang</h2>
      <p class="text-3xl font-bold text-blue-600 mb-4">1,250</p>
      <canvas id="chartStokBarang" height="100"></canvas>
    </div>

    <div class="bg-white p-6 rounded-xl shadow text-center">
      <h2 class="text-lg font-semibold mb-2">Barang Masuk</h2>
      <p class="text-3xl font-bold text-green-600 mb-4">55</p>
      <canvas id="chartBarangMasuk" height="100"></canvas>
    </div>

    <div class="bg-white p-6 rounded-xl shadow text-center">
      <h2 class="text-lg font-semibold mb-2">Barang Keluar Hari Ini</h2>
      <p class="text-3xl font-bold text-red-600 mb-4">15</p>
      <canvas id="chartBarangKeluar" height="100"></canvas>
    </div>

    <div class="bg-white p-6 rounded-xl shadow text-center">
      <h2 class="text-lg font-semibold mb-2">Notifikasi Baru</h2>
      <p class="text-3xl font-bold text-yellow-600 mb-4">5</p>
      <canvas id="chartNotifikasi" height="100"></canvas>
    </div>
  </div>
</main>

<script>
  const ctxStok = document.getElementById('chartStokBarang').getContext('2d');
  new Chart(ctxStok, {
    type: 'line',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
      datasets: [{
        label: 'Total Stok',
        data: [100, 200, 250, 230, 300, 400, 380, 420, 450, 470, 500, 520],
        borderColor: 'rgba(37, 99, 235, 0.9)',
        backgroundColor: 'rgba(37, 99, 235, 0.1)',
        tension: 0.3,
        fill: true,
        pointRadius: 4
      }]
    },
    options: { plugins: { legend: { display: false } } }
  });

  const ctxMasuk = document.getElementById('chartBarangMasuk').getContext('2d');
  new Chart(ctxMasuk, {
    type: 'bar',
    data: {
      labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
      datasets: [{
        label: 'Barang Masuk',
        data: [12, 13, 15, 5, 10, 0, 0],
        backgroundColor: 'rgba(34, 197, 94, 0.7)',
        borderRadius: 6
      }]
    },
    options: {
      plugins: { legend: { display: false } },
      scales: { y: { display: false } }
    }
  });

  const ctxKeluar = document.getElementById('chartBarangKeluar').getContext('2d');
  new Chart(ctxKeluar, {
    type: 'bar',
    data: {
      labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
      datasets: [{
        label: 'Barang Keluar',
        data: [5, 10, 8, 15, 15, 0, 0],
        backgroundColor: 'rgba(239, 68, 68, 0.7)',
        borderRadius: 6
      }]
    },
    options: {
      plugins: { legend: { display: false } },
      scales: { y: { display: false } }
    }
  });

  const ctxNotif = document.getElementById('chartNotifikasi').getContext('2d');
  new Chart(ctxNotif, {
    type: 'bar',
    data: {
      labels: ['Permintaan Baru'],
      datasets: [{
        label: 'Notifikasi',
        data: [4],
        backgroundColor: [
          'rgba(59, 130, 246, 0.8)',
        ],
        borderWidth: 1
      }]
    },
  });
</script>
@endsection
