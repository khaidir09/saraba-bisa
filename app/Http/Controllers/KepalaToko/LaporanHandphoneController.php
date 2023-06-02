<?php

namespace App\Http\Controllers\KepalaToko;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PhoneTransaction;

class LaporanHandphoneController extends Controller
{
    public function index()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $phone_transactions = PhoneTransaction::with('user', 'customer', 'phone')->where('is_approve', 'Setuju')->orderByDesc('created_at')->get();
        $count = PhoneTransaction::where('is_approve', 'Setuju')->count();
        $omzethari = PhoneTransaction::where('is_approve', 'Setuju')
            ->whereDate('tgl_disetujui', today())
            ->get()
            ->sum('omzet');
        $profithari = PhoneTransaction::where('is_approve', 'Setuju')
            ->whereDate('tgl_disetujui', today())
            ->get()
            ->sum('profittoko');
        $omzetbulan = PhoneTransaction::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->get()
            ->sum('omzet');
        $profitbulan = PhoneTransaction::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->get()
            ->sum('profittoko');
        $omzettahun = PhoneTransaction::where('is_approve', 'Setuju')
            ->whereYear('tgl_disetujui', $currentYear)
            ->get()
            ->sum('omzet');
        $profittahun = PhoneTransaction::where('is_approve', 'Setuju')
            ->whereYear('created_at', $currentYear)
            ->get()
            ->sum('profittoko');
        return view('pages/kepalatoko/laporan-handphone', compact('phone_transactions', 'count', 'omzethari', 'profithari', 'omzetbulan', 'profitbulan', 'omzettahun', 'profittahun'));
    }
}
