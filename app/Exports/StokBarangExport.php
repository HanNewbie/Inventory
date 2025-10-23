<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StokBarangExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Barang::select('id', 'nama_barang', 'jumlah_stok', 'deskripsi')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Barang',
            'Jumlah',
            'Keterangan'
        ];
    }
}
