<?php

namespace App\Http\Controllers\Sales;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccessoryTransaction;
use Illuminate\Support\Facades\Auth;

class LaporanAksesorisController extends Controller
{
    public function index()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $penjualanhari = AccessoryTransaction::where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereDate('tgl_disetujui', today())
            ->get()
            ->sum('quantity');
        $profithari = AccessoryTransaction::where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereDate('tgl_disetujui', today())
            ->get()
            ->sum('profit');
        $penjualanbulan = AccessoryTransaction::where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->get()
            ->sum('quantity');
        $profitbulan = AccessoryTransaction::where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->get()
            ->sum('profit');
        $penjualantahun = AccessoryTransaction::where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereYear('tgl_disetujui', $currentYear)
            ->get()
            ->sum('quantity');
        $profittahun = AccessoryTransaction::where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereYear('tgl_disetujui', $currentYear)
            ->get()
            ->sum('profit');
        return view(
            'pages/sales/aksesoris/laporan-aksesoris',
            compact('profithari', 'profitbulan', 'profittahun', 'penjualanhari', 'penjualanbulan', 'penjualantahun')
        );
    }
}
