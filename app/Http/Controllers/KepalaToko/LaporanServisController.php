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

        $services = ServiceTransaction::with('serviceaction')->orderByDesc('tgl_ambil')->get();
        $services_count = ServiceTransaction::with('serviceaction')->where('status_servis', 'Sudah Diambil')->count();
        $omzethari = ServiceTransaction::with('serviceaction')->whereDate('tgl_ambil', today())
            ->get()
            ->sum('omzet');
        $profithari = ServiceTransaction::with('serviceaction')
            ->whereDate('tgl_ambil', today())
            ->get()
            ->sum('profit');
        $omzetbulan = ServiceTransaction::with('serviceaction')
            ->whereMonth('tgl_ambil', $currentMonth)
            ->get()
            ->sum('omzet');
        $profitbulan = ServiceTransaction::with('serviceaction')
            ->whereMonth('tgl_ambil', $currentMonth)
            ->get()
            ->sum('profit');
        $omzettahun = ServiceTransaction::with('serviceaction')
            ->whereYear('tgl_ambil', $currentYear)
            ->get()
            ->sum('omzet');
        $profittahun = ServiceTransaction::with('serviceaction')
            ->whereYear('tgl_ambil', $currentYear)
            ->get()
            ->sum('profit');
        return view('pages/kepalatoko/laporan-servis', compact('services', 'services_count', 'omzethari', 'profithari', 'omzetbulan', 'profitbulan', 'omzettahun', 'profittahun'));
    }
}
