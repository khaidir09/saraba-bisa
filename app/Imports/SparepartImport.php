<?php

namespace App\Imports;

use App\Models\Sparepart;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

class SparepartImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Sparepart([
            'name'     => $row['Nama Sparepart'],
            'stok'    => $row['Stok'],
            'modal'    => $row['Modal'],
            'harga_toko'    => $row['Harga Pelanggan Toko'],
            'harga_pelanggan'    => $row['Harga Pelanggan Biasa'],
            'supplier'    => $row['Supplier'],
        ]);
    }
}
