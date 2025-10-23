<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithTitle;

class StokBarangExport implements FromCollection, WithHeadings ,WithStyles, ShouldAutoSize, WithTitle
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

    public function styles(Worksheet $sheet)
    {
        // Header styling
        $sheet->getStyle('A1:D1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 12,
            ],
            'fill' => [
                'fillType' => 'solid',
                'color' => ['rgb' => '4F81BD'],
            ],
            'alignment' => [
                'horizontal' => 'center',
                'vertical' => 'center',
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => 'thin',
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        // Semua isi tabel → center dan kasih border
        $lastRow = $sheet->getHighestRow();
        $sheet->getStyle("A2:D{$lastRow}")->applyFromArray([
            'alignment' => [
                'horizontal' => 'center',
                'vertical' => 'center',
                'wrapText' => true, // biar teks panjang turun ke bawah otomatis
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => 'thin',
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        // Tinggi baris otomatis biar rapi
        for ($row = 1; $row <= $lastRow; $row++) {
            $sheet->getRowDimension($row)->setRowHeight(20);
        }

        return [];
    }

    public function title(): string
    {
        return 'Data Stok Barang';
    }
}
