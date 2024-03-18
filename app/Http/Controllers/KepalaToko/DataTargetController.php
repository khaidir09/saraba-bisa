<?php

namespace App\Http\Controllers\KepalaToko;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataTargetController extends ApiController
{

    /**
     * @param Request $request
     * @return mixed
     */
    public function getDataTarget()
    {
        $monthlyData = DB::table('targets')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('YEAR(created_at) as year'), DB::raw('SUM(target) as target'), DB::raw('SUM(persen) as persen'), DB::raw('SUM(nilai) as nilai'))
            ->groupBy(DB::raw('MONTH(created_at)'), DB::raw('YEAR(created_at)'))
            ->orderBy(DB::raw('YEAR(created_at)'), 'asc')
            ->orderBy(DB::raw('MONTH(created_at)'), 'asc')
            ->get();

        $labels = [];
        $target = [];
        $persen = [];
        $nilai = [];

        foreach ($monthlyData as $data) {
            $month = date('Y-m-d', mktime(0, 0, 0, $data->month, 1, $data->year));
            $labels[] = $month;
            $target[] = $data->target;
            $persen[] = $data->persen;
            $nilai[] = $data->nilai;
        }

        $data = [
            'labels' => $labels,
            'target' => $target,
            'persen' => $persen,
            'nilai' => $nilai,
        ];

        return response()->json($data); // Mengembalikan data dalam format JSON
    }
}
