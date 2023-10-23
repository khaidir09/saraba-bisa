<?php

namespace App\Http\Controllers\Sales;

use App\Models\Debt;
use App\Models\Order;
use App\Models\Budget;
use App\Models\OrderDetail;
use App\Models\ServiceTransaction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    /**
     * Displays the dashboard screen
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $currentMonth = now()->month;

        $totalbudgets = Budget::all()->sum('total');
        $totalbiayaservis = ServiceTransaction::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->get()
            ->sum('profittoko');

        $rumustotalpenjualan = Order::whereHas('detailOrders', function ($query) {
            $query->where('is_approve', 'Setuju')
                ->whereYear('tgl_disetujui', now()->year)
                ->whereMonth('tgl_disetujui', now()->month);
        })
            ->with(['detailOrders' => function ($query) {
                $query->select('orders_id', DB::raw('SUM(profit_toko) as total_profit'))
                    ->groupBy('orders_id');
            }])
            ->select('id')
            ->get();

        $totalpenjualan = $rumustotalpenjualan->sum(function ($order) {
            return $order->detailOrders->sum('total_profit');
        });

        $totalprofit = $totalbiayaservis + $totalpenjualan;

        $profitpenjualan = OrderDetail::where('users_id', Auth::user()->id)
            ->whereHas('order', function ($query) use ($currentMonth) {
                $query->where('is_approve', 'Setuju')
                    ->whereYear('tgl_disetujui', now()->year)
                    ->whereMonth('tgl_disetujui', $currentMonth);
            })
            ->get()
            ->sum('profit');

        $bonuspenjualan = ($profitpenjualan / 100) * Auth::user()->persen;

        $totalbonus = $bonuspenjualan;

        return view('pages/sales/dashboard', compact(
            'totalbonus',
            'totalbiayaservis',
            'totalbudgets',
            'totalprofit'
        ));
    }
}
