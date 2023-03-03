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
        $penjualanhari = SparepartTransaction::where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereDay('created_at', '=', date("d", strtotime(now())))
            ->sum('quantity');
        $profithari = SparepartTransaction::where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereDay('created_at', '=', date("d", strtotime(now())))
            ->get()
            ->sum('profit');
        $penjualanbulan = SparepartTransaction::where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereMonth('created_at', '=', date("m", strtotime(now())))
            ->sum('quantity');
        $profitbulan = SparepartTransaction::where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereMonth('created_at', '=', date("m", strtotime(now())))
            ->get()
            ->sum('profit');
        $penjualantahun = SparepartTransaction::where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereYear('created_at', '=', date("Y", strtotime(now())))
            ->sum('quantity');
        $profittahun = SparepartTransaction::where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereYear('created_at', '=', date("Y", strtotime(now())))
            ->get()
            ->sum('profit');
        return view('pages/sales/sparepart/laporan-sparepart', compact('profithari', 'profitbulan', 'profittahun', 'penjualanhari', 'penjualanbulan', 'penjualantahun'));
    }
}
