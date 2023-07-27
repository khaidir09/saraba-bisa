<?php

namespace App\Http\Controllers\Teknisi;

use App\Models\Budget;
use App\Models\Assembly;
use App\Models\OrderDetail;
use App\Models\Debt;
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

        $kasbon = Debt::where('workers_id', Auth::user()->worker->id)
            ->where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->sum('total');

        $profitservis = ServiceTransaction::with('serviceaction')
            ->where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->get()
            ->sum('profit');
        $bonusservis = ($profitservis / 100) * Auth::user()->persen;
        $bonusassembly = Assembly::with('user')
            ->where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->get()
            ->sum('biaya');
        $totalbonus = $bonusservis + $bonusassembly - $kasbon;

        $totalbudgets = Budget::all()->sum('total');
        $totalbiayaservis = ServiceTransaction::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->get()
            ->sum('profittoko');
        $totalpenjualan = OrderDetail::whereMonth('created_at', $currentMonth)
            ->get()
            ->sum('profit_toko');
        $totalprofit = $totalbiayaservis + $totalpenjualan;

        return view('pages/teknisi/dashboard', compact(
            'totalbiayaservis',
            'totalbudgets',
            'totalprofit',
            'totalpenjualan',
            'totalbonus',
            'kasbon'
        ));
    }
}
