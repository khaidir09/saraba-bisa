<?php

namespace App\Http\Controllers\KepalaToko;

use Illuminate\Http\Request;
use App\Models\ServiceTransaction;
use App\Http\Controllers\Controller;

class LaporanServisController extends Controller
{
    public function index()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $services = ServiceTransaction::with('serviceaction')->where('is_approve', 'Setuju')->orderByDesc('tgl_ambil')->get();
        $services_count = ServiceTransaction::with('serviceaction')->where('is_approve', 'Setuju')->count();
        $omzethari = ServiceTransaction::with('serviceaction')
            ->where('is_approve', 'Setuju')
            ->whereDate('tgl_disetujui', today())
            ->get()
            ->sum('omzet');
        $profithari = ServiceTransaction::with('serviceaction')
            ->where('is_approve', 'Setuju')
            ->whereDate('tgl_disetujui', today())
            ->get()
            ->sum('profittoko');
        $omzetbulan = ServiceTransaction::with('serviceaction')
            ->where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->get()
            ->sum('omzet');
        $profitbulan = ServiceTransaction::with('serviceaction')
            ->where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->get()
            ->sum('profittoko');
        $omzettahun = ServiceTransaction::with('serviceaction')
            ->where('is_approve', 'Setuju')
            ->whereYear('tgl_disetujui', $currentYear)
            ->get()
            ->sum('omzet');
        $profittahun = ServiceTransaction::with('serviceaction')
            ->where('is_approve', 'Setuju')
            ->whereYear('tgl_disetujui', $currentYear)
            ->get()
            ->sum('profittoko');
        return view('pages/kepalatoko/laporan-servis', compact('services', 'services_count', 'omzethari', 'profithari', 'omzetbulan', 'profitbulan', 'omzettahun', 'profittahun'));
    }
}
