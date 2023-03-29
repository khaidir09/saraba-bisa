<?php

namespace App\Http\Controllers\KepalaToko;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PhoneTransaction;
use App\Models\SparepartTransaction;

class LaporanSparepartController extends Controller
{
    public function index()
    {
        $sparepart_transactions = SparepartTransaction::with('user', 'customer', 'sparepart')->where('is_approve', 'Setuju')->orderByDesc('created_at')->get();
        $count = SparepartTransaction::where('is_approve', 'Setuju')->count();
        $omzethari = SparepartTransaction::where('is_approve', 'Setuju')
            ->whereDay('tgl_disetujui', '=', date("d", strtotime(now())))
            ->get()
            ->sum('omzet');
        $profithari = SparepartTransaction::where('is_approve', 'Setuju')
            ->whereDay('tgl_disetujui', '=', date("d", strtotime(now())))
            ->get()
            ->sum('profittoko');
        $omzetbulan = SparepartTransaction::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', '=', date("m", strtotime(now())))
            ->get()
            ->sum('omzet');
        $profitbulan = SparepartTransaction::where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', '=', date("m", strtotime(now())))
            ->get()
            ->sum('profittoko');
        $omzettahun = SparepartTransaction::where('is_approve', 'Setuju')
            ->whereYear('tgl_disetujui', '=', date("Y", strtotime(now())))
            ->get()
            ->sum('omzet');
        $profittahun = SparepartTransaction::where('is_approve', 'Setuju')
            ->whereYear('tgl_disetujui', '=', date("Y", strtotime(now())))
            ->get()
            ->sum('profittoko');
        return view('pages/kepalatoko/laporan-sparepart', compact('sparepart_transactions', 'count', 'omzethari', 'profithari', 'omzetbulan', 'profitbulan', 'omzettahun', 'profittahun'));
    }
}
