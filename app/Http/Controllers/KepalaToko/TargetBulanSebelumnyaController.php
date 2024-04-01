<?php

namespace App\Http\Controllers\KepalaToko;

use App\Models\Order;
use App\Models\Budget;
use App\Models\Target;
use Illuminate\Http\Request;
use App\Models\ServiceTransaction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TargetBulanSebelumnyaController extends Controller
{
    public function store(Request $request)
    {
        $target = Budget::all()->sum('total');

        $lastMonth = now()->subMonth(); // Mendapatkan tanggal bulan sebelumnya

        $date = $lastMonth->endOfMonth(); // Set the value of $date to the last date of the previous month

        $bulanprofitbersihservis = ServiceTransaction::whereYear('tgl_ambil', now()->year)
            ->whereMonth('tgl_ambil', $lastMonth)
            ->where('is_approve', 'Setuju')
            ->get()
            ->sum('profittoko');

        $profitpenjualan = Order::whereHas('detailOrders', function ($query) {
            $lastMonth = now()->subMonth();
            $query->whereYear('created_at', now()->year)
                ->whereMonth('created_at', $lastMonth)
                ->where('is_approve', 'Setuju');
        })
            ->with(['detailOrders' => function ($query) {
                $query->select('orders_id', DB::raw('SUM(profit_toko) as total_profit'))
                    ->groupBy('orders_id');
            }])
            ->select('id')
            ->get();

        $bulanprofitbersihpenjualan = $profitpenjualan->sum(function ($order) {
            return $order->detailOrders->sum('total_profit');
        });

        $bulantotalprofitbersih = ($bulanprofitbersihservis + $bulanprofitbersihpenjualan);

        $persen = round(($bulantotalprofitbersih / $target) * 100);

        Target::create([
            'target' => $target,
            'persen' => $persen,
            'nilai' => $bulantotalprofitbersih,
            'created_at' => $date,
            'updated_at' => $date,
        ]);

        return redirect()->route('target.index');
    }
}
