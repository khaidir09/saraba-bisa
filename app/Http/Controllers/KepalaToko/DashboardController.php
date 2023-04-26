<?php

namespace App\Http\Controllers\KepalaToko;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Budget;
use App\Models\PhoneTransaction;
use App\Models\ServiceTransaction;
use App\Http\Controllers\Controller;
use App\Models\AccessoryTransaction;
use App\Models\Assembly;
use App\Models\Debt;
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
        $omzetservistoday = ServiceTransaction::where('status_servis', 'Sudah Diambil')
            ->whereDay('tgl_ambil', '=', date("d", strtotime(now())))
            ->get()
            ->sum('omzet');
        $omzetspareparttoday = SparepartTransaction::whereDay('created_at', '=', date("d", strtotime(now())))
            ->get()
            ->sum('omzet');
        $omzetaksesoritoday = AccessoryTransaction::whereDay('created_at', '=', date("d", strtotime(now())))
            ->get()
            ->sum('omzet');
        $omzethandphonetoday = PhoneTransaction::whereDay('created_at', '=', date("d", strtotime(now())))
            ->get()
            ->sum('omzet');
        $totalomzettoday = $omzetservistoday + $omzetspareparttoday + $omzetaksesoritoday + $omzethandphonetoday;

        $profitservistoday = ServiceTransaction::where('status_servis', 'Sudah Diambil')
            ->whereDay('tgl_ambil', '=', date("d", strtotime(now())))
            ->get()
            ->sum('profit');
        $profitspareparttoday = SparepartTransaction::whereDay('created_at', '=', date("d", strtotime(now())))
            ->get()
            ->sum('profit');
        $profitaksesoritoday = AccessoryTransaction::whereDay('created_at', '=', date("d", strtotime(now())))
            ->get()
            ->sum('profit');
        $profithandphonetoday = PhoneTransaction::whereDay('created_at', '=', date("d", strtotime(now())))
            ->get()
            ->sum('profit');
        $totalprofittoday = $profitservistoday + $profitspareparttoday + $profitaksesoritoday + $profithandphonetoday;

        $users = User::with('servicetransaction')
            ->where('role', 'Teknisi')
            ->get();

        $approveservis = ServiceTransaction::where('is_approve', null)
            ->where('status_servis', 'Sudah Diambil')
            ->count();
        $approvehandphone = PhoneTransaction::where('is_approve', null)
            ->count();
        $approveaksesoris = AccessoryTransaction::where('is_approve', null)
            ->count();
        $approvesparepart = SparepartTransaction::where('is_approve', null)
            ->count();
        $approveassembly = Assembly::where('is_approve', null)
            ->count();
        $approvekasbon = Debt::where('is_approve', null)->count();

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

        return view('pages/kepalatoko/dashboard', compact(
            'totalomzettoday',
            'totalprofittoday',
            'approveservis',
            'approvehandphone',
            'approveaksesoris',
            'approvesparepart',
            'approveassembly',
            'approvekasbon',
            'users',
            'totalbiayaservis',
            'totalbudgets',
            'totalprofit',
            'totalpenjualan',
            'totalsparepart',
            'totalaksesoris',
            'totalhandphone',
        ));
    }
}
