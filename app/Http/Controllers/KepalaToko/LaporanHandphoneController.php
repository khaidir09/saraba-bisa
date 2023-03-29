<?php

namespace App\Http\Controllers\KepalaToko;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PhoneTransaction;

class LaporanHandphoneController extends Controller
{
    public function index()
    {
        $phone_transactions = PhoneTransaction::with('user', 'customer', 'phone')->where('is_approve', 'Setuju')->orderByDesc('created_at')->get();
        $count = PhoneTransaction::where('is_approve', 'Setuju')->count();
        $omzethari = PhoneTransaction::where('is_approve', 'Setuju')
            ->whereDay('tgl_disetujui', '=', date("d", strtotime(now())))
            ->get()
            ->sum('omzet');
        $profithari = PhoneTransaction::where('is_approve', 'Setuju')
            ->whereDay('tgl_disetujui', '=', date("d", strtotime(now())))
            ->get()
            ->sum('profittoko');
        $omzetbulan = PhoneTransaction::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', '=', date("m", strtotime(now())))
            ->get()
            ->sum('omzet');
        $profitbulan = PhoneTransaction::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', '=', date("m", strtotime(now())))
            ->get()
            ->sum('profittoko');
        $omzettahun = PhoneTransaction::where('is_approve', 'Setuju')
            ->whereYear('tgl_disetujui', '=', date("Y", strtotime(now())))
            ->get()
            ->sum('omzet');
        $profittahun = PhoneTransaction::where('is_approve', 'Setuju')
            ->whereYear('created_at', '=', date("Y", strtotime(now())))
            ->get()
            ->sum('profittoko');
        return view('pages/kepalatoko/laporan-handphone', compact('phone_transactions', 'count', 'omzethari', 'profithari', 'omzetbulan', 'profitbulan', 'omzettahun', 'profittahun'));
    }
}
