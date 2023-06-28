<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;

class LaporanPenjualanController extends Controller
{
    public function index()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $penjualanhari = OrderDetail::where('users_id', Auth::user()->id)->whereDate('created_at', today())
            ->get()
            ->sum('quantity');
        $bonushari = OrderDetail::where('users_id', Auth::user()->id)->whereDate('created_at', today())
            ->get()
            ->sum('profit');
        $penjualanbulan = OrderDetail::where('users_id', Auth::user()->id)->whereMonth('created_at', $currentMonth)
            ->get()
            ->sum('quantity');
        $bonusbulan = OrderDetail::where('users_id', Auth::user()->id)->whereMonth('created_at', $currentMonth)
            ->get()
            ->sum('profit');
        $penjualantahun = OrderDetail::where('users_id', Auth::user()->id)->whereYear('created_at', $currentYear)
            ->get()
            ->sum('quantity');
        $bonustahun = OrderDetail::where('users_id', Auth::user()->id)->whereYear('created_at', $currentYear)
            ->get()
            ->sum('profit');
        return view('pages/sales/laporan-penjualan', compact('penjualanhari', 'bonushari', 'penjualanbulan', 'bonusbulan', 'penjualantahun', 'bonustahun'));
    }
}
