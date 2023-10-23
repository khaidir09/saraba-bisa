<?php

namespace App\Imports;

use App\Models\Accessory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class AksesorisImport implements ToModel, WithHeadingRow, WithBatchInserts, WithUpserts
{
    public function model(array $row)
    {
        return new Accessory([
            'name'     => $row['Nama Aksesori'],
            'stok'    => $row['Stok'],
            'modal'    => $row['Modal'],
            'harga_toko'    => $row['Harga Pelanggan Toko'],
            'harga_pelanggan'    => $row['Harga Pelanggan Biasa'],
            'supplier'    => $row['Supplier'],
        ]);
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function uniqueBy()
    {
        return 'name';
    }
}
