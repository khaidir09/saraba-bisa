<?php

namespace App\Imports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PelangganImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Customer([
            'nama'     => $row['Nama Pelanggan'],
            'kategori'    => $row['Kategori Pelanggan'],
            'nomor_hp'    => $row['Nomor HP'],
            'alamat'    => $row['Alamat']
        ]);
    }
}
