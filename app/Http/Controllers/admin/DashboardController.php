<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang_masuk;
use App\Models\Barang_keluar;
use App\Models\Barang;
use App\Models\Notifikasi;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $stokPerBulanRaw = Barang::selectRaw('MONTH(created_at) as bulan, SUM(jumlah_stok) as total_stok')
            ->whereYear('created_at', now()->year)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $labelBulan = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
        $dataBulanChart = array_fill(0, 12, 0);
        foreach($stokPerBulanRaw as $item){
            $index = (int) $item->bulan - 1;
            if($index >= 0 && $index < 12){
                $dataBulanChart[$index] = $item->total_stok;
            }
        }

        $weekDays = ['Mon'=>'Senin','Tue'=>'Selasa','Wed'=>'Rabu','Thu'=>'Kamis','Fri'=>'Jumat','Sat'=>'Sabtu','Sun'=>'Minggu'];

        $barangMasukRaw = Barang_masuk::selectRaw('DATE(created_at) as tanggal, SUM(jumlah_masuk) as total')
            ->where('created_at', '>=', now()->startOfWeek())
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->pluck('total', 'tanggal')
            ->toArray();

        $dataHarianMasuk = [];
        $labelHarianMasuk = [];
        foreach($weekDays as $key=>$day){
            $found = false;
            foreach($barangMasukRaw as $tgl => $total){
                if(Carbon::parse($tgl)->format('D') === $key){
                    $dataHarianMasuk[] = $total;
                    $labelHarianMasuk[] = $day;
                    $found = true;
                    break;
                }
            }
            if(!$found){
                $dataHarianMasuk[] = 0;
                $labelHarianMasuk[] = $day;
            }
        }

        $barangKeluarRaw = Barang_keluar::selectRaw('DATE(created_at) as tanggal, SUM(jumlah_keluar) as total')
            ->where('created_at', '>=', now()->startOfWeek())
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->pluck('total', 'tanggal')
            ->toArray();

        $dataHarianKeluar = [];
        $labelHarianKeluar = [];
        foreach($weekDays as $key=>$day){
            $found = false;
            foreach($barangKeluarRaw as $tgl => $total){
                if(Carbon::parse($tgl)->format('D') === $key){
                    $dataHarianKeluar[] = $total;
                    $labelHarianKeluar[] = $day;
                    $found = true;
                    break;
                }
            }
            if(!$found){
                $dataHarianKeluar[] = 0;
                $labelHarianKeluar[] = $day;
            }
        }

        $jumlahNotifikasi = Notifikasi::where('status', 'pending')->count();

        return view('admin.dashboard', compact(
            'labelBulan', 'dataBulanChart',
            'labelHarianMasuk', 'dataHarianMasuk',
            'labelHarianKeluar', 'dataHarianKeluar',
            'jumlahNotifikasi'
        ));
    }
}
