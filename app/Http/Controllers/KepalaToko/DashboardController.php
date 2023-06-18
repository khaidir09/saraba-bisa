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
        $totalprofit = $totalbiayaservis;

        $omzetservis = ServiceTransaction::where('status_servis', 'Sudah Diambil')
            ->whereDate('tgl_ambil', today())
            ->get()
            ->sum('omzet');
        $totalomzet = $omzetservis;

        $profitservis = ServiceTransaction::where('status_servis', 'Sudah Diambil')
            ->whereDate('tgl_ambil', today())
            ->get()
            ->sum('profit');
        $totalprofitutuh = $profitservis;

        return view('pages/kepalatoko/dashboard', compact(
            'types',
            'totalbiayaservis',
            'totalbudgets',
            'totalprofit',
            'totalomzet',
            'totalprofitutuh'
        ));
    }
}
