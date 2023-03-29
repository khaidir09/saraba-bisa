<?php

namespace App\Http\Controllers\AdminToko;

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
        $biayaservis = ServiceTransaction::where('is_admin_toko', 'Admin')
            ->where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', '=', date("m", strtotime(now())))
            ->get()
            ->sum('profit');
        $profitsparepart = SparepartTransaction::where('is_admin_toko', 'Admin')
            ->where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', '=', date("m", strtotime(now())))
            ->get()
            ->sum('profit');
        $profitaksesoris = AccessoryTransaction::where('is_admin_toko', 'Admin')
            ->where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', '=', date("m", strtotime(now())))
            ->get()
            ->sum('profit');
        $profithandphone = PhoneTransaction::where('is_admin_toko', 'Admin')
            ->where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', '=', date("m", strtotime(now())))
            ->get()
            ->sum('profit');
        $totalbonus = ($biayaservis / 100 + $profitsparepart / 100 + $profitaksesoris / 100 + $profithandphone / 100) * Auth::user()->persen;

        $totalbudgets = Budget::all()->sum('total');
        $totalbiayaservis = ServiceTransaction::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', '=', date("m", strtotime(now())))
            ->get()
            ->sum('profittoko');
        $totalsparepart = SparepartTransaction::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', '=', date("m", strtotime(now())))
            ->get()
            ->sum('profittoko');
        $totalaksesoris = AccessoryTransaction::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', '=', date("m", strtotime(now())))
            ->get()
            ->sum('profittoko');
        $totalhandphone = PhoneTransaction::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', '=', date("m", strtotime(now())))
            ->get()
            ->sum('profittoko');
        $totalprofit = $totalbiayaservis + $totalsparepart + $totalaksesoris + $totalhandphone;
        $totalpenjualan = $totalsparepart + $totalaksesoris + $totalhandphone;

        return view('pages/admintoko/dashboard', compact(
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
