<?php

namespace App\Exports;

use App\Models\Accessory;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AksesorisExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Accessory::all();
    }

    public function map($accessory): array
    {
        return [
            $accessory->name,
            $accessory->stok,
            $accessory->modal,
            $accessory->harga_toko,
            $accessory->harga_pelanggan,
            $accessory->supplier
        ];
    }

    public function headings(): array
    {
        return [
            'Nama Aksesori',
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
            1    => ['font' => ['bold' => true]],
        ];
    }
}
