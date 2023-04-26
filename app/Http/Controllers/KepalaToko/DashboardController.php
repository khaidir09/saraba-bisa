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
            ->whereDay('tgl_disetujui', '=', date("d", strtotime(now())))
            ->get()
            ->sum('profittoko');
        $totalsparepart = SparepartTransaction::where('is_approve', 'Setuju')
            ->whereDay('tgl_disetujui', '=', date("d", strtotime(now())))
            ->get()
            ->sum('profittoko');
        $totalaksesoris = AccessoryTransaction::where('is_approve', 'Setuju')
            ->whereDay('tgl_disetujui', '=', date("d", strtotime(now())))
            ->get()
            ->sum('profittoko');
        $totalhandphone = PhoneTransaction::where('is_approve', 'Setuju')
            ->whereDay('tgl_disetujui', '=', date("d", strtotime(now())))
            ->get()
            ->sum('profittoko');
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
            'totalomzet',
            'totalprofitutuh'
        ));
    }
}
