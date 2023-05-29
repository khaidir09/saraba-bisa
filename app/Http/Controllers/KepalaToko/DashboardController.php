<?php

namespace App\Http\Controllers\KepalaToko;

use Carbon\Carbon;
use App\Models\Budget;
use App\Models\PhoneTransaction;
use App\Models\ServiceTransaction;
use App\Http\Controllers\Controller;
use App\Models\AccessoryTransaction;
use App\Models\SparepartTransaction;
use App\Models\Type;

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

        $types = Type::with('service')->get();
        $totalbudgets = Budget::all()->sum('total');
        $totalbiayaservis = ServiceTransaction::where('status_servis', 'Sudah Diambil')->whereMonth('created_at', $currentMonth)
            ->get()
            ->sum('profit');
        $totalsparepart = SparepartTransaction::whereMonth('created_at', $currentMonth)
            ->get()
            ->sum('profit');
        $totalaksesoris = AccessoryTransaction::whereMonth('created_at', $currentMonth)
            ->get()
            ->sum('profit');
        $totalhandphone = PhoneTransaction::whereMonth('created_at', $currentMonth)
            ->get()
            ->sum('profit');
        $totalprofit = $totalbiayaservis + $totalsparepart + $totalaksesoris + $totalhandphone;
        $totalpenjualan = $totalsparepart + $totalaksesoris + $totalhandphone;

        $omzetservis = ServiceTransaction::where('status_servis', 'Sudah Diambil')
            ->whereDate('tgl_ambil', today())
            ->get()
            ->sum('omzet');
        $omzetsparepart = SparepartTransaction::whereDate('created_at', today())
            ->get()
            ->sum('omzet');
        $omzetaksesori = AccessoryTransaction::whereDate('created_at', today())
            ->get()
            ->sum('omzet');
        $omzethandphone = PhoneTransaction::whereDate('created_at', today())
            ->get()
            ->sum('omzet');
        $totalomzet = $omzetservis + $omzetsparepart + $omzetaksesori + $omzethandphone;

        $profitservis = ServiceTransaction::where('status_servis', 'Sudah Diambil')
            ->whereDate('tgl_ambil', today())
            ->get()
            ->sum('profit');
        $profitsparepart = SparepartTransaction::whereDate('created_at', today())
            ->get()
            ->sum('profit');
        $profitaksesori = AccessoryTransaction::whereDate('created_at', today())
            ->get()
            ->sum('profit');
        $profithandphone = PhoneTransaction::whereDate('created_at', today())
            ->get()
            ->sum('profit');
        $totalprofitutuh = $profitservis + $profitsparepart + $profitaksesori + $profithandphone;

        return view('pages/kepalatoko/dashboard', compact(
            'types',
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
