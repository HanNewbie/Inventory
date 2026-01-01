@extends('layouts.admin')

@section('content')
<main class="p-4 sm:p-6 bg-gray-100 min-h-screen">

    <h1 class="text-xl sm:text-2xl font-bold mb-4 sm:mb-6 text-gray-800">
        Selamat Datang, {{ auth()->user()->username }}
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 max-w-6xl mx-auto">

        <div class="bg-white p-4 sm:p-6 rounded-xl shadow text-center">
            <h2 class="text-sm sm:text-lg font-semibold mb-2">
                Total Stok Barang per Bulan
            </h2>
            <p class="text-2xl sm:text-3xl font-bold text-blue-600 mb-4">
                {{ array_sum($dataBulanChart) }}
            </p>
            <div class="h-40 sm:h-48">
                <canvas id="chartStokBarang"></canvas>
            </div>
        </div>

        <div class="bg-white p-4 sm:p-6 rounded-xl shadow text-center">
            <h2 class="text-sm sm:text-lg font-semibold mb-2">
                Barang Masuk (7 Hari Terakhir)
            </h2>
            <p class="text-2xl sm:text-3xl font-bold text-green-600 mb-4">
                {{ array_sum($dataHarianMasuk) }}
            </p>
            <div class="h-40 sm:h-48">
                <canvas id="chartBarangMasuk"></canvas>
            </div>
        </div>

        <div class="bg-white p-4 sm:p-6 rounded-xl shadow text-center">
            <h2 class="text-sm sm:text-lg font-semibold mb-2">
                Barang Keluar (7 Hari Terakhir)
            </h2>
            <p class="text-2xl sm:text-3xl font-bold text-red-600 mb-4">
                {{ array_sum($dataHarianKeluar) }}
            </p>
            <div class="h-40 sm:h-48">
                <canvas id="chartBarangKeluar"></canvas>
            </div>
        </div>

        <div class="bg-white p-4 sm:p-6 rounded-xl shadow text-center">
            <h2 class="text-sm sm:text-lg font-semibold mb-2">
                Notifikasi Baru
            </h2>
            <p class="text-2xl sm:text-3xl font-bold text-yellow-600 mb-4">
                {{ $jumlahNotifikasi }}
            </p>
            <div class="h-40 sm:h-48">
                <canvas id="chartNotifikasi"></canvas>
            </div>
        </div>

    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const baseOptions = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        legend: { display: false }
    }
};

new Chart(document.getElementById('chartStokBarang'), {
    type: 'line',
    data: {
        labels: @json($labelBulan),
        datasets: [{
            data: @json($dataBulanChart),
            borderColor: '#2563eb',
            backgroundColor: 'rgba(37,99,235,.15)',
            tension: .35,
            fill: true,
            pointRadius: 3
        }]
    },
    options: baseOptions
});

new Chart(document.getElementById('chartBarangMasuk'), {
    type: 'bar',
    data: {
        labels: @json($labelHarianMasuk),
        datasets: [{
            data: @json($dataHarianMasuk),
            backgroundColor: 'rgba(34,197,94,.7)',
            borderRadius: 4
        }]
    },
    options: {
        ...baseOptions,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1,
                    precision: 0
                }
            }
        }
    }
});


new Chart(document.getElementById('chartBarangKeluar'), {
    type: 'bar',
    data: {
        labels: @json($labelHarianKeluar),
        datasets: [{
            data: @json($dataHarianKeluar),
            backgroundColor: 'rgba(239,68,68,.7)',
            borderRadius: 4
        }]
    },
    options: {
        ...baseOptions,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1,
                    precision: 0
                }
            }
        }
    }
});


new Chart(document.getElementById('chartNotifikasi'), {
    type: 'bar',
    data: {
        labels: ['Permintaan Baru'],
        datasets: [{
            data: [@json($jumlahNotifikasi)],
            backgroundColor: 'rgba(234,179,8,.8)',
            borderRadius: 4
        }]
    },
    options: {
        ...baseOptions,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1,
                    precision: 0
                }
            }
        }
    }
});
</script>
@endsection
