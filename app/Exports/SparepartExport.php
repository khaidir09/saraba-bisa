<?php

namespace App\Exports;

use App\Models\Sparepart;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class SparepartExport implements FromCollection, WithMapping, WithHeadings, WithCustomStartCell, ShouldAutoSize, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Sparepart::all();
    }

    public function map($sparepart): array
    {
        return [
            $sparepart->name,
            $sparepart->stok,
            $sparepart->modal,
            $sparepart->harga_toko,
            $sparepart->harga_pelanggan,
            $sparepart->supplier
        ];
    }

    public function headings(): array
    {
        return [
            'Nama Sparepart',
            'Stok',
            'Modal',
            'Harga Pelanggan Toko',
            'Harga Pelanggan Biasa',
            'Supplier'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            2    => ['font' => ['bold' => true]],
        ];
    }

    public function startCell(): string
    {
        return 'B2';
    }
}
