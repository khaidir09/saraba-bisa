<?php

namespace App\Http\Controllers\KepalaToko;

use Carbon\Carbon;
use App\Models\Budget;
use App\Models\PhoneTransaction;
use App\Models\ServiceTransaction;
use App\Http\Controllers\Controller;
use App\Models\AccessoryTransaction;
use App\Models\SparepartTransaction;

class DashboardController extends Controller
{

    /**
     * Displays the dashboard screen
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $totalbudgets = Budget::all()->sum('total');
        $totalbiayaservis = ServiceTransaction::where('status_servis', 'Sudah Diambil')->whereMonth('created_at', '=', date("m", strtotime(now())))
            ->get()
            ->sum('profit');
        $totalsparepart = SparepartTransaction::whereMonth('created_at', '=', date("m", strtotime(now())))
            ->get()
            ->sum('profit');
        $totalaksesoris = AccessoryTransaction::whereMonth('created_at', '=', date("m", strtotime(now())))
            ->get()
            ->sum('profit');
        $totalhandphone = PhoneTransaction::whereMonth('created_at', '=', date("m", strtotime(now())))
            ->get()
            ->sum('profit');
        $totalprofit = $totalbiayaservis + $totalsparepart + $totalaksesoris + $totalhandphone;
        $totalpenjualan = $totalsparepart + $totalaksesoris + $totalhandphone;

        $omzetservis = ServiceTransaction::where('status_servis', 'Sudah Diambil')
            ->whereDay('tgl_ambil', '=', date("d", strtotime(now())))
            ->get()
            ->sum('omzet');
        $omzetsparepart = SparepartTransaction::whereDay('created_at', '=', date("d", strtotime(now())))
            ->get()
            ->sum('omzet');
        $omzetaksesori = AccessoryTransaction::whereDay('created_at', '=', date("d", strtotime(now())))
            ->get()
            ->sum('omzet');
        $omzethandphone = PhoneTransaction::whereDay('created_at', '=', date("d", strtotime(now())))
            ->get()
            ->sum('omzet');
        $totalomzet = $omzetservis + $omzetsparepart + $omzetaksesori + $omzethandphone;

        $profitservis = ServiceTransaction::where('status_servis', 'Sudah Diambil')
            ->whereDay('tgl_ambil', '=', date("d", strtotime(now())))
            ->get()
            ->sum('profit');
        $profitsparepart = SparepartTransaction::whereDay('created_at', '=', date("d", strtotime(now())))
            ->get()
            ->sum('profit');
        $profitaksesori = AccessoryTransaction::whereDay('created_at', '=', date("d", strtotime(now())))
            ->get()
            ->sum('profit');
        $profithandphone = PhoneTransaction::whereDay('created_at', '=', date("d", strtotime(now())))
            ->get()
            ->sum('profit');
        $totalprofitutuh = $profitservis + $profitsparepart + $profitaksesori + $profithandphone;

        return view('pages/kepalatoko/dashboard', compact(
            'totalbiayaservis',
            'totalbudgets',
            'totalprofit',
            'totalpenjualan',
            'totalsparepart',
            'totalaksesoris',
            'totalhandphone',
            'totalomzet',
            'totalprofitutuh'
        ));
    }
}
