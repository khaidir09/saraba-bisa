<?php

namespace App\Http\Controllers\Sales;

use App\Models\Debt;
use App\Models\Budget;
use App\Models\OrderDetail;
use App\Models\ServiceTransaction;
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
        $totalpenjualan = OrderDetail::whereMonth('created_at', $currentMonth)
            ->get()
            ->sum('profit_toko');
        $totalprofit = $totalbiayaservis + $totalpenjualan;

        $profitpenjualan = OrderDetail::where('users_id', Auth::user()->id)
            ->whereMonth('created_at', $currentMonth)
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
