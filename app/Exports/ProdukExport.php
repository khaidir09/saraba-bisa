<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProdukExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Product::all();
    }

    public function map($serviceaction): array
    {
        return [
            $serviceaction->product_name,
            $serviceaction->product_code,
            $serviceaction->nomor_seri,
            $serviceaction->categories_id,
            $serviceaction->stok,
            $serviceaction->harga_modal,
            $serviceaction->harga_jual,
            $serviceaction->supplier,
            $serviceaction->keterangan,
        ];
    }

    public function headings(): array
    {
        return [
            'Nama Produk',
            'Kode Produk',
            'Nomor Seri',
            'ID Kategori',
            'Stok',
            'Harga Modal',
            'Harga Jual',
            'Agen',
            'Keterangan',
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
