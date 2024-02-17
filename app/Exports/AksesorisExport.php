<?php

namespace App\Exports;

use App\Models\Product;
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
        return Product::where('categories_id', '=', '3')->get();
    }

    public function map($product): array
    {
        return [
            $product->sub_categories_id,
            $product->product_name,
            $product->model_series_id,
            $product->product_code,
            $product->stok,
            $product->stok_minimal,
            $product->harga_modal,
            $product->harga_jual,
            $product->keterangan,
            $product->garansi,
            $product->ppn,
        ];
    }

    public function headings(): array
    {
        return [
            'ID Sub Kategori',
            'Nama Produk',
            'ID Model Seri',
            'Kode Produk',
            'Stok',
            'Stok Minimal',
            'Harga Modal',
            'Harga Jual',
            'Keterangan',
            'Garansi Produk (Hari)',
            'PPN 11%',
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
