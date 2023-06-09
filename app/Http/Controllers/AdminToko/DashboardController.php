<?php

namespace App\Http\Controllers\AdminToko;

use Carbon\Carbon;
use App\Models\Type;
use App\Models\User;
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
        $currentMonth = now()->month;

        $types = Type::with('service')->get();

        $biayaservis = ServiceTransaction::where('is_admin_toko', 'Admin')
            ->where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->get()
            ->sum('profit');

        $totalbonus = ($biayaservis / 100) * Auth::user()->persen;

        $totalbudgets = Budget::all()->sum('total');
        $totalbiayaservis = ServiceTransaction::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->get()
            ->sum('profittoko');

        $totalprofit = $totalbiayaservis;

        return view('pages/admintoko/dashboard', compact(
            'types',
            'totalbiayaservis',
            'totalbudgets',
            'totalprofit',
            'totalbonus'
        ));
    }
}
