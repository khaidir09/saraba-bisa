<?php

namespace App\Http\Controllers\KepalaToko;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;

class LaporanPajakPenjualanController extends Controller
{
    public function index()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $product_transactions = OrderDetail::with('product', 'user')->get();
        $count = OrderDetail::all()->count();
        $produkhari = OrderDetail::whereDate('created_at', today())
            ->where('ppn', '>', '0')
            ->get()
            ->sum('quantity');
        $ppnhari = OrderDetail::whereDate('created_at', today())
            ->where('ppn', '>', '0')
            ->get()
            ->sum('ppn');
        $produkbulan = OrderDetail::whereMonth('created_at', $currentMonth)
            ->where('ppn', '>', '0')
            ->get()
            ->sum('quantity');
        $ppnbulan = OrderDetail::whereMonth('created_at', $currentMonth)
            ->where('ppn', '>', '0')
            ->get()
            ->sum('ppn');
        $produktahun = OrderDetail::whereYear('created_at', $currentYear)
            ->where('ppn', '>', '0')
            ->get()
            ->sum('quantity');
        $ppntahun = OrderDetail::whereYear('created_at', $currentYear)
            ->where('ppn', '>', '0')
            ->get()
            ->sum('ppn');

        return view('pages/kepalatoko/laporan-pajak-penjualan', compact('product_transactions', 'count', 'produkhari', 'ppnhari', 'produkbulan', 'ppnbulan', 'produktahun', 'ppntahun'));
    }
}
