<?php

namespace App\Http\Controllers\AdminToko;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Budget;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderDetail;
use App\Models\ServiceTransaction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

        $users = User::with('servicetransaction')
            ->where('role', 'Teknisi')
            ->get();
        $categories = Category::all();

        $categorySales = [];
        foreach ($categories as $category) {
            $totalSales = OrderDetail::totalSales($category->id);
            $categorySales[] = [
                'category' => $category->category_name,
                'total_sales' => $totalSales,
            ];
        }

        $biayaservis = ServiceTransaction::where('is_admin_toko', 'Admin')
            ->where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->get()
            ->sum('profit');
        $profitpenjualan = OrderDetail::where('is_admin_toko', 'Admin')
            ->whereMonth('created_at', $currentMonth)
            ->get()
            ->sum('profit');

        $adminbiayaservis = ServiceTransaction::where('is_admin_toko', 'Admin')
            ->where('admin_id', Auth::user()->id)
            ->where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->get()
            ->sum('profit');
        $adminprofitpenjualan = OrderDetail::where('is_admin_toko', 'Admin')
            ->where('admin_id', Auth::user()->id)
            ->whereHas('order', function ($query) use ($currentMonth) {
                $query->where('is_approve', 'Setuju')
                    ->whereYear('tgl_disetujui', now()->year)
                    ->whereMonth('tgl_disetujui', $currentMonth);
            })
            ->get()
            ->sum('profit');

        $totalbonus = ($adminbiayaservis / 100 + $adminprofitpenjualan / 100) * Auth::user()->persen;

        $totalbudgets = Budget::all()->sum('total');
        $totalbiayaservis = ServiceTransaction::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->get()
            ->sum('profittoko');

        $rumustotalpenjualan = Order::whereHas('detailOrders', function ($query) {
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

        $totalpenjualan = $rumustotalpenjualan->sum(function ($order) {
            return $order->detailOrders->sum('total_profit');
        });

        $totalprofit = $totalbiayaservis + $totalpenjualan;

        // Ambil data transaksi servis yang memiliki status "Belum cek"
        $transactions = ServiceTransaction::where('status_servis', 'Belum cek')->get();

        // Cek apakah ada transaksi yang lebih dari 7 hari dari data dibuat
        $currentDate = Carbon::now();
        $reminderThreshold = 7; // Jumlah hari sebelum pengingat ditampilkan
        $reminders = $transactions->filter(function ($transaction) use ($currentDate, $reminderThreshold) {
            return $transaction->created_at->addDays($reminderThreshold)->isPast();
        })->count();

        $stokhabis = Product::where('stok', 0)->count();

        return view('pages/admintoko/dashboard', compact(
            'users',
            'categories',
            'categorySales',
            'totalbiayaservis',
            'totalpenjualan',
            'totalbudgets',
            'totalprofit',
            'totalbonus',
            'reminders',
            'stokhabis'
        ));
    }
}
