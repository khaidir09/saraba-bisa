<?php

namespace App\Http\Controllers\KepalaToko;

use Carbon\Carbon;
use App\Models\Debt;
use App\Models\User;
use App\Models\Budget;
use App\Models\Expense;
use App\Models\Assembly;
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
        $users = User::with('servicetransaction')
            ->where('role', 'Teknisi')
            ->get();

        $pengeluaran = Expense::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', '=', date("m", strtotime(now())))
            ->count();
        $totalpengeluaran = Expense::where('is_approve', 'Setuju')->sum('price');

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
        $approvepengeluaran = Expense::where('is_approve', null)->count();

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

        $totalprofitbiayaservis = ServiceTransaction::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', '=', date("m", strtotime(now())))
            ->get()
            ->sum('profit');
        $totalprofitsparepart = SparepartTransaction::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', '=', date("m", strtotime(now())))
            ->get()
            ->sum('profit');
        $totalprofitaksesoris = AccessoryTransaction::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', '=', date("m", strtotime(now())))
            ->get()
            ->sum('profit');
        $totalprofithandphone = PhoneTransaction::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', '=', date("m", strtotime(now())))
            ->get()
            ->sum('profit');

        $totalprofit = $totalbiayaservis + $totalsparepart + $totalaksesoris + $totalhandphone;
        $totalpenjualan = $totalsparepart + $totalaksesoris + $totalhandphone;
        $totalprofitkotor = ($totalprofitbiayaservis + $totalprofitsparepart + $totalprofitaksesoris + $totalprofithandphone);

        return view('pages/kepalatoko/dashboard', compact(
            'approveassembly',
            'approveservis',
            'approvehandphone',
            'approveaksesoris',
            'approvesparepart',
            'approvekasbon',
            'users',
            'totalbiayaservis',
            'totalbudgets',
            'totalprofitbiayaservis',
            'totalprofitsparepart',
            'totalprofitaksesoris',
            'totalprofithandphone',
            'totalprofit',
            'totalpenjualan',
            'totalsparepart',
            'totalaksesoris',
            'totalhandphone',
            'pengeluaran',
            'totalpengeluaran',
            'approvepengeluaran',
            'totalprofitkotor'
        ));
    }
}
