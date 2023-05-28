<?php

namespace App\Http\Controllers\Sales;

use Illuminate\Http\Request;
use App\Models\PhoneTransaction;
use App\Models\ServiceTransaction;
use App\Http\Controllers\Controller;
use App\Models\SparepartTransaction;
use Illuminate\Support\Facades\Auth;

class LaporanSparepartController extends Controller
{
    public function index()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $penjualanhari = SparepartTransaction::where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereDate('tgl_disetujui', today())
            ->sum('quantity');
        $profithari = SparepartTransaction::where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereDate('tgl_disetujui', today())
            ->get()
            ->sum('profit');
        $penjualanbulan = SparepartTransaction::where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->sum('quantity');
        $profitbulan = SparepartTransaction::where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->get()
            ->sum('profit');
        $penjualantahun = SparepartTransaction::where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereYear('tgl_disetujui', $currentYear)
            ->sum('quantity');
        $profittahun = SparepartTransaction::where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereYear('tgl_disetujui', $currentYear)
            ->get()
            ->sum('profit');
        return view('pages/sales/sparepart/laporan-sparepart', compact('profithari', 'profitbulan', 'profittahun', 'penjualanhari', 'penjualanbulan', 'penjualantahun'));
    }
}
