<?php

namespace App\Http\Controllers\KepalaToko;

use App\Http\Controllers\Controller;
use App\Models\SparepartTransaction;

class LaporanSparepartController extends Controller
{
    public function index()
    {
        $sparepart_transactions = SparepartTransaction::with('customer', 'sparepart')->orderByDesc('created_at')->get();
        $count = SparepartTransaction::all()->count();
        $omzethari = SparepartTransaction::whereDay('created_at', '=', date("d", strtotime(now())))
            ->get()
            ->sum('omzet');
        $profithari = SparepartTransaction::whereDay('created_at', '=', date("d", strtotime(now())))
            ->get()
            ->sum('profit');
        $omzetbulan = SparepartTransaction::whereMonth('created_at', '=', date("m", strtotime(now())))
            ->get()
            ->sum('omzet');
        $profitbulan = SparepartTransaction::whereMonth('created_at', '=', date("m", strtotime(now())))
            ->get()
            ->sum('profit');
        $omzettahun = SparepartTransaction::whereYear('created_at', '=', date("Y", strtotime(now())))
            ->get()
            ->sum('omzet');
        $profittahun = SparepartTransaction::whereYear('created_at', '=', date("Y", strtotime(now())))
            ->get()
            ->sum('profit');
        return view('pages/kepalatoko/laporan-sparepart', compact('sparepart_transactions', 'count', 'omzethari', 'profithari', 'omzetbulan', 'profitbulan', 'omzettahun', 'profittahun'));
    }
}
