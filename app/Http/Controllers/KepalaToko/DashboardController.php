<?php

namespace App\Http\Controllers\KepalaToko;

use App\Models\DataFeed;
use App\Models\Debt;
use App\Models\User;
use App\Models\Budget;
use App\Models\Expense;
use App\Models\Assembly;
use App\Models\Category;
use App\Models\OrderDetail;
use App\Models\ServiceTransaction;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    /**
     * Displays the dashboard screen
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $dataService = new ServiceTransaction();

        $omzetservisjanuari = ServiceTransaction::where('status_servis', 'Sudah Diambil')
            ->whereMonth('created_at', 1)
            ->get()
            ->sum('omzet');

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

        $bulanprofitbersihservis = ServiceTransaction::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->get()
            ->sum('profittoko');
        $bulanprofitbersihpenjualan = OrderDetail::whereMonth('created_at', $currentMonth)
            ->get()
            ->sum('profit_toko');

        $bulantotalprofitbersih = ($bulanprofitbersihservis + $bulanprofitbersihpenjualan);

        $bulanprofitkotorservis = ServiceTransaction::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->get()
            ->sum('profit');
        $bulanprofitkotorpenjualan = OrderDetail::whereMonth('created_at', $currentMonth)
            ->get()
            ->sum('profit');

        $bulantotalprofitkotor = ($bulanprofitkotorservis + $bulanprofitkotorpenjualan);

        $haripengeluaran = Expense::where('is_approve', 'Setuju')
            ->whereDate('tgl_disetujui', today())
            ->sum('price');

        $hariomzetservis = ServiceTransaction::where('status_servis', 'Sudah Diambil')
            ->whereDate('tgl_ambil', today())
            ->get()
            ->sum('omzet');
        $hariomzetpenjualan = OrderDetail::whereDate('created_at', today())
            ->get()
            ->sum('total');
        $haritotalomzet = $hariomzetservis + $hariomzetpenjualan;

        $hariprofitkotorservis = ServiceTransaction::where('status_servis', 'Sudah Diambil')
            ->whereDate('tgl_ambil', today())
            ->get()
            ->sum('profit');
        $hariprofitkotorpenjualan = OrderDetail::whereDate('created_at', today())
            ->get()
            ->sum('profit');

        $haritotalprofitkotor = $hariprofitkotorservis + $hariprofitkotorpenjualan;

        $bonusassembly = Assembly::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->get()
            ->sum('biaya');

        return view('pages/kepalatoko/dashboard', compact(
            'dataService',
            'omzetservisjanuari',
            'categories',
            'approveassembly',
            'approveservis',
            'approvekasbon',
            'users',
            'totalbudgets',
            'pengeluaran',
            'totalpengeluaran',
            'approvepengeluaran',
            'haripengeluaran',
            'haritotalomzet',
            'haritotalprofitkotor',
            'bulantotalprofitbersih',
            'bulantotalprofitkotor',
            'bulanprofitbersihservis',
            'bulanprofitbersihpenjualan',
            'bonusassembly',
        ));
    }
}
