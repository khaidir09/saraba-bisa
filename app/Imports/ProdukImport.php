<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class ProdukImport implements ToModel, WithHeadingRow, WithBatchInserts, WithUpserts
{
    public function model(array $row)
    {
        return new Product([
            'product_name'     => $row['Nama Produk'],
            'product_code'    => $row['Kode Produk'],
            'nomor_seri'    => $row['Nomor Seri'],
            'categories_id'    => $row['ID Kategori'],
            'stok'    => $row['Stok'],
            'harga_modal'    => $row['Harga Modal'],
            'harga_pelanggan'    => $row['Harga Pelanggan'],
            'harga_toko'    => $row['Harga Toko'],
            'supplier'    => $row['Agen'],
            'keterangan'    => $row['Keterangan'],
        ]);
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function uniqueBy()
    {
        return 'nomor_seri';
    }
}
