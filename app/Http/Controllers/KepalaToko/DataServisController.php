<?php

namespace App\Http\Controllers\KepalaToko;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataServisController extends ApiController
{

    /**
     * @param Request $request
     * @return mixed
     */
    public function getDataServis()
    {
        $monthlyData = DB::table('service_transactions')
            ->select(DB::raw('MONTH(tgl_ambil) as month'), DB::raw('YEAR(tgl_ambil) as year'), DB::raw('SUM(omzet) as total_omzet'), DB::raw('SUM(profit) as total_profit'))
            ->where('kondisi_servis', 'Sudah jadi')
            ->whereNull('deleted_at') // Menambahkan kondisi where untuk memfilter data yang deleted_at-nya NULL
            ->groupBy(DB::raw('MONTH(tgl_ambil)'), DB::raw('YEAR(tgl_ambil)'))
            ->orderBy(DB::raw('YEAR(tgl_ambil)'), 'asc')
            ->orderBy(DB::raw('MONTH(tgl_ambil)'), 'asc')
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
