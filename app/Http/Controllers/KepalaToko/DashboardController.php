<?php

namespace App\Http\Controllers\KepalaToko;

use Carbon\Carbon;
use App\Models\Type;
use App\Models\Budget;
use App\Models\Expense;
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
        $currentMonth = now()->month;

        $types = Type::with('service')->get();
        $categories = Category::with('order')->get();

        $totalbudgets = Budget::all()->sum('total');

        $pengeluaran = Expense::whereMonth('created_at', $currentMonth)
            ->count();
        $totalpengeluaran = Expense::whereMonth('created_at', $currentMonth)
            ->sum('price');

        $totalbiayaservis = ServiceTransaction::where('status_servis', 'Sudah Diambil')->whereMonth('created_at', $currentMonth)
            ->get()
            ->sum('profit');
        $totalpenjualan = OrderDetail::whereMonth('created_at', $currentMonth)
            ->get()
            ->sum('profit');

        $totalprofit = $totalbiayaservis + $totalpenjualan;

        $totalprofitbiayaservis = ServiceTransaction::whereMonth('created_at', $currentMonth)
            ->get()
            ->sum('profit');

        $totalprofitkotor = $totalprofitbiayaservis + $totalpenjualan;

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
            'types',
            'categories',
            'totalbiayaservis',
            'totalbudgets',
            'totalprofit',
            'totalpenjualan',
            'totalomzet',
            'totalprofitutuh',
            'totalpengeluaran',
            'totalprofitkotor',
            'pengeluaran'
        ));
    }
}
