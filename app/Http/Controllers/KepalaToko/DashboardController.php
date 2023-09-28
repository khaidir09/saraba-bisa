<?php

namespace App\Http\Controllers\KepalaToko;

use Carbon\Carbon;
use App\Models\Debt;
use App\Models\User;
use App\Models\Order;
use App\Models\Budget;
use App\Models\Expense;
use App\Models\Product;
use App\Models\Assembly;
use App\Models\Category;
use App\Models\OrderDetail;
use App\Models\SubCategory;
use App\Models\ServiceTransaction;
use Illuminate\Support\Facades\DB;
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

        $categories = Category::all();

        $categorySales = [];
        foreach ($categories as $category) {
            $totalSales = OrderDetail::totalSales($category->id);
            $categorySales[] = [
                'category' => $category->category_name,
                'total_sales' => $totalSales,
            ];
        }

        $currentMonth = now()->month;

        $users = User::with('servicetransaction')
            ->where('role', 'Teknisi')
            ->get();

        $pengeluaran = Expense::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->count();
        $totalpengeluaran = Expense::where('is_approve', 'Setuju')->whereMonth('tgl_disetujui', $currentMonth)->sum('price');

        // Ambil data transaksi servis yang memiliki status "Belum cek"
        $transactions = ServiceTransaction::where('status_servis', 'Belum cek')->get();

        // Cek apakah ada transaksi yang lebih dari 7 hari dari data dibuat
        $currentDate = Carbon::now();
        $reminderThreshold = 7; // Jumlah hari sebelum pengingat ditampilkan
        $reminders = $transactions->filter(function ($transaction) use ($currentDate, $reminderThreshold) {
            return $transaction->created_at->addDays($reminderThreshold)->isPast();
        })->count();

        $approveservis = ServiceTransaction::where('is_approve', null)
            ->where('status_servis', 'Sudah Diambil')
            ->count();
        $approvepenjualan = Order::where('is_approve', null)->count();
        $approveassembly = Assembly::where('is_approve', null)
            ->count();
        $approvekasbon = Debt::where('is_approve', null)->count();
        $approvepengeluaran = Expense::where('is_approve', null)->count();
        $stokhabis = Product::where('stok', 0)->count();

        $totalbudgets = Budget::all()->sum('total');

        $bulanprofitbersihservis = ServiceTransaction::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->get()
            ->sum('profittoko');
        $profitpenjualan = Order::whereHas('detailOrders', function ($query) {
            $query->where('is_approve', 'Setuju')
                ->whereYear('tgl_disetujui', now()->year)
                ->whereMonth('tgl_disetujui', now()->month);
        })
            ->with(['detailOrders' => function ($query) {
                $query->select('orders_id', DB::raw('SUM(profit_toko) as total_profit'))
                    ->groupBy('orders_id');
            }])
            ->select('id')
            ->get();

        $bulanprofitbersihpenjualan = $profitpenjualan->sum(function ($order) {
            return $order->detailOrders->sum('total_profit');
        });

        $bulantotalprofitbersih = ($bulanprofitbersihservis + $bulanprofitbersihpenjualan);

        $bulanprofitkotorservis = ServiceTransaction::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->get()
            ->sum('profit');
        $rumusprofitkotorpenjualan = Order::whereHas('detailOrders', function ($query) {
            $query->where('is_approve', 'Setuju')
                ->whereYear('tgl_disetujui', now()->year)
                ->whereMonth('tgl_disetujui', now()->month);
        })
            ->with(['detailOrders' => function ($query) {
                $query->select('orders_id', DB::raw('SUM(profit) as total_profit'))
                    ->groupBy('orders_id');
            }])
            ->select('id')
            ->get();

        $bulanprofitkotorpenjualan = $rumusprofitkotorpenjualan->sum(function ($order) {
            return $order->detailOrders->sum('total_profit');
        });

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
            'categorySales',
            'dataService',
            'categories',
            'approveassembly',
            'approveservis',
            'approvepenjualan',
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
            'reminders',
            'stokhabis'
        ));
    }
}
