<?php

namespace App\Http\Controllers\KepalaToko;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Budget;
use App\Models\PhoneTransaction;
use App\Models\ServiceTransaction;
use App\Http\Controllers\Controller;
use App\Models\AccessoryTransaction;
use App\Models\Debt;
use App\Models\Expense;
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
        $pengeluaran = Expense::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth)
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
        $approvekasbon = Debt::where('is_approve', null)->count();
        $approvepengeluaran = Expense::where('is_approve', null)->count();

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

        $totalprofitbiayaservis = ServiceTransaction::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->get()
            ->sum('profit');
        $totalprofitsparepart = SparepartTransaction::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->get()
            ->sum('profit');
        $totalprofitaksesoris = AccessoryTransaction::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->get()
            ->sum('profit');
        $totalprofithandphone = PhoneTransaction::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->get()
            ->sum('profit');

        $totalprofit = ($totalbiayaservis + $totalsparepart + $totalaksesoris + $totalhandphone);
        $totalpenjualan = $totalsparepart + $totalaksesoris + $totalhandphone;
        $totalprofitkotor = ($totalprofitbiayaservis + $totalprofitsparepart + $totalprofitaksesoris + $totalprofithandphone);

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
            'approveservis',
            'approvehandphone',
            'approveaksesoris',
            'approvesparepart',
            'approvekasbon',
            'approvepengeluaran',
            'types',
            'totalbiayaservis',
            'totalbudgets',
            'totalprofit',
            'totalpenjualan',
            'totalsparepart',
            'totalaksesoris',
            'totalhandphone',
            'totalomzet',
            'totalprofitutuh',
            'totalpengeluaran',
            'totalprofitkotor',
            'pengeluaran'
        ));
    }
}
