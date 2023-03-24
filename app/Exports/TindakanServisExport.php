<?php

namespace App\Exports;

use App\Models\ServiceAction;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class TindakanServisExport implements FromCollection, WithMapping, WithHeadings, WithCustomStartCell, ShouldAutoSize, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ServiceAction::all();
    }

    public function map($user): array
    {
        return [
            $user->nama_tindakan,
            $user->modal_sparepart,
            $user->harga_toko,
            $user->harga_pelanggan,
            $user->garansi
        ];
    }

    public function headings(): array
    {
        return [
            'Nama Tindakan',
            'Modal Sparepart',
            'Harga Pelanggan Toko',
            'Harga Pelanggan Biasa',
            'Garansi'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            2    => ['font' => ['bold' => true]],
        ];
    }

    public function startCell(): string
    {
        return 'B2';
    }
}
