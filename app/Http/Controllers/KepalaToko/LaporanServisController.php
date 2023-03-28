<?php

namespace App\Http\Controllers\KepalaToko;

use Illuminate\Http\Request;
use App\Models\ServiceTransaction;
use App\Http\Controllers\Controller;

class LaporanServisController extends Controller
{
    public function index()
    {
        $services = ServiceTransaction::with('serviceaction')->where('is_approve', 'Setuju')->orderByDesc('tgl_ambil')->get();
        $services_count = ServiceTransaction::with('serviceaction')->where('is_approve', 'Setuju')->count();
        $omzethari = ServiceTransaction::with('serviceaction')
            ->where('is_approve', 'Setuju')
            ->whereDay('tgl_disetujui', '=', date("d", strtotime(now())))
            ->get()
            ->sum('omzet');
        $profithari = ServiceTransaction::with('serviceaction')
            ->where('is_approve', 'Setuju')
            ->whereDay('tgl_disetujui', '=', date("d", strtotime(now())))
            ->get()
            ->sum('profittoko');
        $omzetbulan = ServiceTransaction::with('serviceaction')
            ->where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', '=', date("m", strtotime(now())))
            ->get()
            ->sum('omzet');
        $profitbulan = ServiceTransaction::with('serviceaction')
            ->where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', '=', date("m", strtotime(now())))
            ->get()
            ->sum('profittoko');
        $omzettahun = ServiceTransaction::with('serviceaction')
            ->where('is_approve', 'Setuju')
            ->whereYear('tgl_disetujui', '=', date("Y", strtotime(now())))
            ->get()
            ->sum('omzet');
        $profittahun = ServiceTransaction::with('serviceaction')
            ->where('is_approve', 'Setuju')
            ->whereYear('tgl_disetujui', '=', date("Y", strtotime(now())))
            ->get()
            ->sum('profittoko');
        return view('pages/kepalatoko/laporan-servis', compact('services', 'services_count', 'omzethari', 'profithari', 'omzetbulan', 'profitbulan', 'omzettahun', 'profittahun'));
    }
}
