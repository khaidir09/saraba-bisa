<?php

namespace App\Http\Controllers\KepalaToko;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataPenjualanController extends ApiController
{

    /**
     * @param Request $request
     * @return mixed
     */
    public function getDataPenjualan()
    {
        $monthlyData = DB::table('order_details')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('YEAR(created_at) as year'), DB::raw('SUM(total) as total_omzet'), DB::raw('SUM(profit) as total_profit'))
            ->whereNull('deleted_at') // Menambahkan kondisi where untuk memfilter data yang deleted_at-nya NULL
            ->groupBy(DB::raw('MONTH(created_at)'), DB::raw('YEAR(created_at)'))
            ->orderBy(DB::raw('YEAR(created_at)'), 'asc')
            ->orderBy(DB::raw('MONTH(created_at)'), 'asc')
            ->get();

        $labels = [];
        $omzet = [];
        $profit = [];

        foreach ($monthlyData as $data) {
            $month = date('Y-m-d', mktime(0, 0, 0, $data->month, 1, $data->year));
            $labels[] = $month;
            $omzet[] = $data->total_omzet;
            $profit[] = $data->total_profit;
        }

        $data = [
            'labels' => $labels,
            'omzet' => $omzet,
            'profit' => $profit,
        ];

        return response()->json($data); // Mengembalikan data dalam format JSON
    }
}
