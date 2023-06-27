<?php

namespace App\Http\Controllers\KepalaToko;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Budget;
use App\Models\PhoneTransaction;
use App\Models\ServiceTransaction;
use App\Http\Controllers\Controller;
use App\Models\AccessoryTransaction;
use App\Models\Category;
use App\Models\Debt;
use App\Models\Expense;
use App\Models\OrderDetail;
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
        $categories = Category::with('order')->get();

        $pengeluaran = Expense::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->count();
        $totalpengeluaran = Expense::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->sum('price');
        $approveservis = ServiceTransaction::where('is_approve', null)
            ->where('status_servis', 'Sudah Diambil')
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

        $hariomzetservis = ServiceTransaction::where('status_servis', 'Sudah Diambil')
            ->whereDate('tgl_ambil', today())
            ->get()
            ->sum('omzet');
        $hariomzetpenjualan = OrderDetail::whereDate('created_at', today())
            ->get()
            ->sum('total');
        $haritotalomzet = ($hariomzetservis + $hariomzetpenjualan);

        $hariprofitkotorservis = ServiceTransaction::where('status_servis', 'Sudah Diambil')
            ->whereDate('tgl_ambil', today())
            ->get()
            ->sum('profit');
        $hariprofitkotorpenjualan = OrderDetail::whereDate('created_at', today())
            ->get()
            ->sum('profit');
        $haritotalprofitkotor = $hariprofitkotorservis + $hariprofitkotorpenjualan;

        return view('pages/kepalatoko/dashboard', compact(
            'types',
            'categories',
            'totalpengeluaran',
            'pengeluaran',
            'approveservis',
            'approvekasbon',
            'approvepengeluaran',
            'totalbudgets',
            'haritotalomzet',
            'haritotalprofitkotor',
            'bulantotalprofitbersih',
            'bulantotalprofitkotor',
            'bulanprofitbersihservis',
            'bulanprofitbersihpenjualan'
        ));
    }
}
