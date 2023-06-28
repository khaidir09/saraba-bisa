<?php

namespace App\Http\Controllers\Sales;

use Carbon\Carbon;
use App\Models\Budget;
use App\Models\DataFeed;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Models\PhoneTransaction;
use App\Models\ServiceTransaction;
use App\Http\Controllers\Controller;
use App\Models\AccessoryTransaction;
use App\Models\SparepartTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

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

        $bonusbulan = OrderDetail::where('users_id', Auth::user()->id)->whereMonth('created_at', $currentMonth)
            ->get()
            ->sum('profit');

        $totalprofit = $totalbiayaservis + $totalpenjualan;

        return view('pages/sales/dashboard', compact(
            'bonusbulan',
            'totalbiayaservis',
            'totalbudgets',
            'totalprofit'
        ));
    }
}
