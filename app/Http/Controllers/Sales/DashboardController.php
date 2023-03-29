<?php

namespace App\Http\Controllers\Sales;

use Carbon\Carbon;
use App\Models\Budget;
use App\Models\DataFeed;
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
        $profitsparepart = SparepartTransaction::where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereMonth('created_at', '=', date("m", strtotime(now())))
            ->get()
            ->sum('profit');
        $bonussparepart = ($profitsparepart / 100) * Auth::user()->persen;
        $profitaksesori = AccessoryTransaction::where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereMonth('created_at', '=', date("m", strtotime(now())))
            ->get()
            ->sum('profit');
        $bonusaksesori = ($profitaksesori / 100) * Auth::user()->persen;
        $profithandphone = PhoneTransaction::where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereMonth('tgl_disetujui', '=', date("m", strtotime(now())))
            ->get()
            ->sum('profit');
        $bonushandphone = ($profithandphone / 100) * Auth::user()->persen;
        $totalbonus = $bonussparepart + $bonusaksesori + $bonushandphone;

        $totalbudgets = Budget::all()->sum('total');
        $totalbiayaservis = ServiceTransaction::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', '=', date("m", strtotime(now())))
            ->get()
            ->sum('profittoko');
        $totalsparepart = SparepartTransaction::where('is_approve', 'Setuju')
            ->whereMonth('created_at', '=', date("m", strtotime(now())))
            ->get()
            ->sum('profittoko');
        $totalaksesoris = AccessoryTransaction::where('is_approve', 'Setuju')
            ->whereMonth('created_at', '=', date("m", strtotime(now())))
            ->get()
            ->sum('profittoko');
        $totalhandphone = PhoneTransaction::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', '=', date("m", strtotime(now())))
            ->get()
            ->sum('profittoko');
        $totalprofit = $totalbiayaservis + $totalsparepart + $totalaksesoris + $totalhandphone;
        $totalpenjualan = $totalsparepart + $totalaksesoris + $totalhandphone;

        return view('pages/sales/dashboard', compact(
            'totalbiayaservis',
            'totalbudgets',
            'totalprofit',
            'totalpenjualan',
            'totalsparepart',
            'totalaksesoris',
            'totalhandphone',
            'totalbonus'
        ));
    }
}
