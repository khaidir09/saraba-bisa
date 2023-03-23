<?php

namespace App\Imports;

use App\Models\Phone;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class HandphoneImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Phone([
            'name'     => $row['Nama Aksesori'],
            'stok'    => $row['Stok'],
            'modal'    => $row['Modal'],
            'harga_toko'    => $row['Harga Pelanggan Toko'],
            'harga_pelanggan'    => $row['Harga Pelanggan Biasa'],
            'supplier'    => $row['Supplier'],
        ]);
    }
}
