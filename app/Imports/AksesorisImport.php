<?php

namespace App\Imports;

use App\Models\Accessory;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AksesorisImport implements ToModel, WithHeadingRow
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
}
