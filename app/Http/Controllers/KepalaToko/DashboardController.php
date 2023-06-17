<?php

namespace App\Http\Controllers\KepalaToko;

use Carbon\Carbon;
use App\Models\Debt;
use App\Models\User;
use App\Models\Budget;
use App\Models\Expense;
use App\Models\Assembly;
use App\Models\Category;
use App\Models\OrderDetail;
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
        $categories = Category::with('order')->get();

        $currentMonth = now()->month;

        $users = User::with('servicetransaction')
            ->where('role', 'Teknisi')
            ->get();

        $pengeluaran = Expense::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->count();
        $totalpengeluaran = Expense::where('is_approve', 'Setuju')->whereMonth('tgl_disetujui', $currentMonth)->sum('price');

        $approveservis = ServiceTransaction::where('is_approve', null)
            ->where('status_servis', 'Sudah Diambil')
            ->count();
        $approveassembly = Assembly::where('is_approve', null)
            ->count();
        $approvekasbon = Debt::where('is_approve', null)->count();
        $approvepengeluaran = Expense::where('is_approve', null)->count();

        $totalbudgets = Budget::all()->sum('total');
        $totalbiayaservis = ServiceTransaction::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->get()
            ->sum('profittoko');
        $totalpenjualan = OrderDetail::whereMonth('created_at', $currentMonth)
            ->get()
            ->sum('profit');

        $totalprofitbiayaservis = ServiceTransaction::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->get()
            ->sum('profit');

        $totalprofit = ($totalbiayaservis + $totalpenjualan);
        $totalprofitkotor = ($totalprofitbiayaservis + $totalpenjualan);

        $omzetservis = ServiceTransaction::where('status_servis', 'Sudah Diambil')
            ->whereDate('tgl_ambil', today())
            ->get()
            ->sum('omzet');
        $omzetpenjualan = OrderDetail::whereDate('created_at', today())
            ->get()
            ->sum('total');
        $totalomzet = $omzetservis + $omzetpenjualan;

        $profitservis = ServiceTransaction::where('status_servis', 'Sudah Diambil')
            ->whereDate('tgl_ambil', today())
            ->get()
            ->sum('profit');
        $profitpenjualan = OrderDetail::whereDate('created_at', today())
            ->get()
            ->sum('profit');
        $totalprofitutuh = $profitservis + $profitpenjualan;

        return view('pages/kepalatoko/dashboard', compact(
            'categories',
            'approveassembly',
            'approveservis',
            'approvekasbon',
            'users',
            'totalbiayaservis',
            'totalbudgets',
            'totalprofitbiayaservis',
            'totalprofit',
            'totalpenjualan',
            'pengeluaran',
            'totalpengeluaran',
            'approvepengeluaran',
            'totalprofitkotor',
            'totalomzet',
            'totalprofitutuh'
        ));
    }
}
