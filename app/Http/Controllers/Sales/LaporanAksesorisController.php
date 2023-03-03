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
        $penjualanhari = AccessoryTransaction::where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereDay('created_at', '=', date("d", strtotime(now())))
            ->get()
            ->sum('quantity');
        $profithari = AccessoryTransaction::where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereDay('created_at', '=', date("d", strtotime(now())))
            ->get()
            ->sum('profit');
        $penjualanbulan = AccessoryTransaction::where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereMonth('created_at', '=', date("m", strtotime(now())))
            ->get()
            ->sum('quantity');
        $profitbulan = AccessoryTransaction::where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereMonth('created_at', '=', date("m", strtotime(now())))
            ->get()
            ->sum('profit');
        $penjualantahun = AccessoryTransaction::where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereYear('created_at', '=', date("Y", strtotime(now())))
            ->get()
            ->sum('quantity');
        $profittahun = AccessoryTransaction::where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereYear('created_at', '=', date("Y", strtotime(now())))
            ->get()
            ->sum('profit');
        return view(
            'pages/sales/aksesoris/laporan-aksesoris',
            compact('profithari', 'profitbulan', 'profittahun', 'penjualanhari', 'penjualanbulan', 'penjualantahun')
        );
    }
}
