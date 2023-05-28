<?php

namespace App\Http\Controllers\Teknisi;

use Carbon\Carbon;
use App\Models\Budget;
use App\Models\DataFeed;
use Illuminate\Http\Request;
use App\Models\PhoneTransaction;
use App\Models\ServiceTransaction;
use App\Http\Controllers\Controller;
use App\Models\AccessoryTransaction;
use App\Models\Expense;
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

        $profitservis = ServiceTransaction::with('serviceaction')
            ->where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->get()
            ->sum('profit');
        $bonusservis = ($profitservis / 100) * Auth::user()->persen;
        $totalbonus = $bonusservis;

        $totalbudgets = Budget::all()->sum('total');
        $totalbiayaservis = ServiceTransaction::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->get()
            ->sum('profittoko');
        $totalsparepart = SparepartTransaction::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->get()
            ->sum('profittoko');
        $totalaksesoris = AccessoryTransaction::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->get()
            ->sum('profittoko');
        $totalhandphone = PhoneTransaction::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->get()
            ->sum('profittoko');
        $totalprofit = $totalbiayaservis + $totalsparepart + $totalaksesoris + $totalhandphone;
        $totalpenjualan = $totalsparepart + $totalaksesoris + $totalhandphone;

        return view('pages/teknisi/dashboard', compact(
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
