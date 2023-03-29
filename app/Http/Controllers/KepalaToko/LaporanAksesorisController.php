<?php

namespace App\Http\Controllers\KepalaToko;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccessoryTransaction;

class LaporanAksesorisController extends Controller
{
    public function index()
    {
        $accessory_transactions = AccessoryTransaction::with('user', 'customer', 'accessory')->where('is_approve', 'Setuju')->orderByDesc('created_at')->get();
        $count = AccessoryTransaction::where('is_approve', 'Setuju')->count();
        $omzethari = AccessoryTransaction::where('is_approve', 'Setuju')
            ->whereDay('tgl_disetujui', '=', date("d", strtotime(now())))
            ->get()
            ->sum('omzet');
        $profithari = AccessoryTransaction::where('is_approve', 'Setuju')
            ->whereDay('tgl_disetujui', '=', date("d", strtotime(now())))
            ->get()
            ->sum('profittoko');
        $omzetbulan = AccessoryTransaction::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', '=', date("m", strtotime(now())))
            ->get()
            ->sum('omzet');
        $profitbulan = AccessoryTransaction::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', '=', date("m", strtotime(now())))
            ->get()
            ->sum('profittoko');
        $omzettahun = AccessoryTransaction::where('is_approve', 'Setuju')
            ->whereYear('tgl_disetujui', '=', date("Y", strtotime(now())))
            ->get()
            ->sum('omzet');
        $profittahun = AccessoryTransaction::where('is_approve', 'Setuju')
            ->whereYear('tgl_disetujui', '=', date("Y", strtotime(now())))
            ->get()
            ->sum('profittoko');
        return view('pages/kepalatoko/laporan-aksesoris', compact('accessory_transactions', 'count', 'omzethari', 'profithari', 'omzetbulan', 'profitbulan', 'omzettahun', 'profittahun'));
    }
}
