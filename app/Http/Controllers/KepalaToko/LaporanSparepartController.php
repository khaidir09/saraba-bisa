<?php

namespace App\Http\Controllers\KepalaToko;

use App\Http\Controllers\Controller;
use App\Models\SparepartTransaction;

class LaporanSparepartController extends Controller
{
    public function index()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $sparepart_transactions = SparepartTransaction::with('customer', 'sparepart')->orderByDesc('created_at')->get();
        $count = SparepartTransaction::all()->count();
        $omzethari = SparepartTransaction::whereDate('created_at', today())
            ->get()
            ->sum('omzet');
        $profithari = SparepartTransaction::whereDate('created_at', today())
            ->get()
            ->sum('profit');
        $omzetbulan = SparepartTransaction::whereMonth('created_at', $currentMonth)
            ->get()
            ->sum('omzet');
        $profitbulan = SparepartTransaction::whereMonth('created_at', $currentMonth)
            ->get()
            ->sum('profit');
        $omzettahun = SparepartTransaction::whereYear('created_at', $currentYear)
            ->get()
            ->sum('omzet');
        $profittahun = SparepartTransaction::whereYear('created_at', $currentYear)
            ->get()
            ->sum('profit');
        return view('pages/kepalatoko/laporan-sparepart', compact('sparepart_transactions', 'count', 'omzethari', 'profithari', 'omzetbulan', 'profitbulan', 'omzettahun', 'profittahun'));
    }
}
