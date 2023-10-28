<?php

namespace App\Http\Controllers\KepalaToko;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataPengeluaranController extends ApiController
{

    /**
     * @param Request $request
     * @return mixed
     */
    public function getDataPengeluaran()
    {
        $monthlyData = DB::table('expenses')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('YEAR(created_at) as year'), DB::raw('SUM(price) as total'))
            ->whereNull('deleted_at') // Menambahkan kondisi where untuk memfilter data yang deleted_at-nya NULL
            ->groupBy(DB::raw('MONTH(created_at)'), DB::raw('YEAR(created_at)'))
            ->orderBy(DB::raw('YEAR(created_at)'), 'asc')
            ->orderBy(DB::raw('MONTH(created_at)'), 'asc')
            ->get();

        $labels = [];
        $pengeluaran = [];

        foreach ($monthlyData as $data) {
            $month = date('Y-m-d', mktime(0, 0, 0, $data->month, 1, $data->year));
            $labels[] = $month;
            $pengeluaran[] = $data->total;
        }

        $data = [
            'labels' => $labels,
            'pengeluaran' => $pengeluaran,
        ];

        return response()->json($data); // Mengembalikan data dalam format JSON
    }
}
