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
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $penjualanhari = PhoneTransaction::with('phone')
            ->where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereDate('tgl_disetujui', today())
            ->count();
        $profithari = PhoneTransaction::where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereDate('tgl_disetujui', today())
            ->get()
            ->sum('profit');
        $penjualanbulan = PhoneTransaction::with('phone')
            ->where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->count();
        $profitbulan = PhoneTransaction::where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->get()
            ->sum('profit');
        $penjualantahun = PhoneTransaction::with('phone')
            ->where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereYear('tgl_disetujui', $currentYear)
            ->count();
        $profittahun = PhoneTransaction::where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereYear('tgl_disetujui', $currentYear)
            ->get()
            ->sum('profit');
        return view('pages/sales/handphone/laporan-handphone', compact('profithari', 'profitbulan', 'profittahun', 'penjualanhari', 'penjualanbulan', 'penjualantahun'));
    }
}
