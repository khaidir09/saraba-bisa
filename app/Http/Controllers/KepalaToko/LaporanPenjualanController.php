<?php

namespace App\Http\Controllers\KepalaToko;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccessoryTransaction;
use App\Models\OrderDetail;

class LaporanPenjualanController extends Controller
{
    public function index()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $product_transactions = OrderDetail::with('product')->get();
        $count = OrderDetail::all()->count();
        $omzethari = OrderDetail::whereDate('created_at', today())
            ->get()
            ->sum('total');
        $profithari = OrderDetail::whereDate('created_at', today())
            ->get()
            ->sum('profit');
        $omzetbulan = OrderDetail::whereMonth('created_at', $currentMonth)
            ->get()
            ->sum('total');
        $profitbulan = OrderDetail::whereMonth('created_at', $currentMonth)
            ->get()
            ->sum('profit');
        $omzettahun = OrderDetail::whereYear('created_at', $currentYear)
            ->get()
            ->sum('total');
        $profittahun = OrderDetail::whereYear('created_at', $currentYear)
            ->get()
            ->sum('profit');
        return view('pages/kepalatoko/laporan-penjualan', compact('product_transactions', 'count', 'omzethari', 'profithari', 'omzetbulan', 'profitbulan', 'omzettahun', 'profittahun'));
    }
}
