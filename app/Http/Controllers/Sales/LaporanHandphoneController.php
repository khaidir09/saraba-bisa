<?php

namespace App\Http\Controllers\Sales;

use Illuminate\Http\Request;
use App\Models\PhoneTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LaporanHandphoneController extends Controller
{
    public function index()
    {
        $penjualanhari = PhoneTransaction::with('phone')
            ->where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereDay('tgl_disetujui', '=', date("d", strtotime(now())))
            ->count();
        $profithari = PhoneTransaction::where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereDay('tgl_disetujui', '=', date("d", strtotime(now())))
            ->get()
            ->sum('profit');
        $penjualanbulan = PhoneTransaction::with('phone')
            ->where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereMonth('tgl_disetujui', '=', date("m", strtotime(now())))
            ->count();
        $profitbulan = PhoneTransaction::where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereMonth('tgl_disetujui', '=', date("m", strtotime(now())))
            ->get()
            ->sum('profit');
        $penjualantahun = PhoneTransaction::with('phone')
            ->where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereYear('tgl_disetujui', '=', date("Y", strtotime(now())))
            ->count();
        $profittahun = PhoneTransaction::where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereYear('tgl_disetujui', '=', date("Y", strtotime(now())))
            ->get()
            ->sum('profit');
        return view('pages/sales/handphone/laporan-handphone', compact('profithari', 'profitbulan', 'profittahun', 'penjualanhari', 'penjualanbulan', 'penjualantahun'));
    }
}
