<?php

namespace App\Http\Controllers\KepalaToko;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class LaporanPenjualanController extends Controller
{
    public function index()
    {

        $product_transactions = OrderDetail::with('product', 'user')->get();
        $count = OrderDetail::all()->count();

        $rumusomzethari = Order::whereHas('detailOrders', function ($query) {
            $query->where('is_approve', 'Setuju')
                ->whereDate('tgl_disetujui', today());
        })
            ->with(['detailOrders' => function ($query) {
                $query->select('orders_id', DB::raw('SUM(total) as total_omzet'))
                    ->groupBy('orders_id');
            }])
            ->select('id')
            ->get();

        $omzethari = $rumusomzethari->sum(function ($order) {
            return $order->detailOrders->sum('total_omzet');
        });

        $rumusprofithari = Order::whereHas('detailOrders', function ($query) {
            $query->where('is_approve', 'Setuju')
                ->whereDate('tgl_disetujui', today());
        })
            ->with(['detailOrders' => function ($query) {
                $query->select('orders_id', DB::raw('SUM(profit_toko) as total_profit'))
                    ->groupBy('orders_id');
            }])
            ->select('id')
            ->get();

        $profithari = $rumusprofithari->sum(function ($order) {
            return $order->detailOrders->sum('total_profit');
        });

        $rumusomzetbulan = Order::whereHas('detailOrders', function ($query) {
            $query->where('is_approve', 'Setuju')
                ->whereYear('tgl_disetujui', now()->year)
                ->whereMonth('tgl_disetujui', now()->month);
        })
            ->with(['detailOrders' => function ($query) {
                $query->select('orders_id', DB::raw('SUM(total) as total_omzet'))
                    ->groupBy('orders_id');
            }])
            ->select('id')
            ->get();

        $omzetbulan = $rumusomzetbulan->sum(function ($order) {
            return $order->detailOrders->sum('total_omzet');
        });

        $rumusprofitbulan = Order::whereHas('detailOrders', function ($query) {
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

        $profitbulan = $rumusprofitbulan->sum(function ($order) {
            return $order->detailOrders->sum('total_profit');
        });

        $rumusomzettahun = Order::whereHas('detailOrders', function ($query) {
            $query->where('is_approve', 'Setuju')
                ->whereYear('tgl_disetujui', now()->year);
        })
            ->with(['detailOrders' => function ($query) {
                $query->select('orders_id', DB::raw('SUM(total) as total_omzet'))
                    ->groupBy('orders_id');
            }])
            ->select('id')
            ->get();

        $omzettahun = $rumusomzettahun->sum(function ($order) {
            return $order->detailOrders->sum('total_omzet');
        });

        $rumusprofittahun = Order::whereHas('detailOrders', function ($query) {
            $query->where('is_approve', 'Setuju')
                ->whereYear('tgl_disetujui', now()->year);
        })
            ->with(['detailOrders' => function ($query) {
                $query->select('orders_id', DB::raw('SUM(profit_toko) as total_profit'))
                    ->groupBy('orders_id');
            }])
            ->select('id')
            ->get();

        $profittahun = $rumusprofittahun->sum(function ($order) {
            return $order->detailOrders->sum('total_profit');
        });

        return view('pages/kepalatoko/laporan-penjualan', compact('product_transactions', 'count', 'omzethari', 'profithari', 'omzetbulan', 'profitbulan', 'omzettahun', 'profittahun'));
    }
}
