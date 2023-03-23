<?php

namespace App\Imports;

use App\Models\ServiceAction;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

class ServiceActionImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new ServiceAction([
            'nama_tindakan'     => $row['Nama Tindakan'],
            'modal_sparepart'    => $row['Modal'],
            'harga_toko'    => $row['Harga Pelanggan Toko'],
            'harga_pelanggan'    => $row['Harga Pelanggan Biasa'],
            'garansi'    => $row['Garansi'],
        ]);
    }
}
