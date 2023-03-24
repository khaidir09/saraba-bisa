<?php

namespace App\Imports;

use App\Models\ModelSerie;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ModelSeriImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new ModelSerie([
            'name'     => $row['Nama Model'],
            'brands_id'     => $row['ID Merek'],
        ]);
    }
}
