<?php

namespace App\Http\Controllers\KepalaToko;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccessoryTransaction;

class LaporanAksesorisController extends Controller
{
    public function index()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $accessory_transactions = AccessoryTransaction::with('customer', 'accessory')->orderByDesc('created_at')->get();
        $count = AccessoryTransaction::all()->count();
        $omzethari = AccessoryTransaction::whereDate('created_at', today())
            ->get()
            ->sum('omzet');
        $profithari = AccessoryTransaction::whereDate('created_at', today())
            ->get()
            ->sum('profit');
        $omzetbulan = AccessoryTransaction::whereMonth('created_at', $currentMonth)
            ->get()
            ->sum('omzet');
        $profitbulan = AccessoryTransaction::whereMonth('created_at', $currentMonth)
            ->get()
            ->sum('profit');
        $omzettahun = AccessoryTransaction::whereYear('created_at', $currentYear)
            ->get()
            ->sum('omzet');
        $profittahun = AccessoryTransaction::whereYear('created_at', $currentYear)
            ->get()
            ->sum('profit');
        return view('pages/kepalatoko/laporan-aksesoris', compact('accessory_transactions', 'count', 'omzethari', 'profithari', 'omzetbulan', 'profitbulan', 'omzettahun', 'profittahun'));
    }
}
