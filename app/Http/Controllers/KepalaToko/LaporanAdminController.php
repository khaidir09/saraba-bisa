<?php

namespace App\Http\Controllers\KepalaToko;

use Illuminate\Http\Request;
use App\Models\ServiceTransaction;
use App\Http\Controllers\Controller;
use App\Models\AccessoryTransaction;
use App\Models\PhoneTransaction;
use App\Models\SparepartTransaction;
use App\Models\User;

class LaporanAdminController extends Controller
{
    public function index()
    {
        $currentMonth = now()->month;

        $users = User::where('role', 'Admin Toko')
            ->get();
        $jumlahservis = ServiceTransaction::where('is_admin_toko', 'Admin')
            ->where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->count();
        $biayaservis = ServiceTransaction::where('is_admin_toko', 'Admin')
            ->where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->get()
            ->sum('profit');
        $jumlahtransaksisparepart = SparepartTransaction::where('is_admin_toko', 'Admin')
            ->where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->count();
        $profitsparepart = SparepartTransaction::where('is_admin_toko', 'Admin')
            ->where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->get()
            ->sum('profit');
        $jumlahtransaksiaksesoris = AccessoryTransaction::where('is_admin_toko', 'Admin')
            ->where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->count();
        $profitaksesoris = AccessoryTransaction::where('is_admin_toko', 'Admin')
            ->where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->get()
            ->sum('profit');
        $jumlahtransaksihandphone = PhoneTransaction::where('is_admin_toko', 'Admin')
            ->where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->count();
        $profithandphone = PhoneTransaction::where('is_admin_toko', 'Admin')
            ->where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->get()
            ->sum('profit');

        return view('pages/kepalatoko/laporan-admin', compact(
            'users',
            'biayaservis',
            'jumlahservis',
            'jumlahtransaksisparepart',
            'profitsparepart',
            'jumlahtransaksiaksesoris',
            'profitaksesoris',
            'jumlahtransaksihandphone',
            'profithandphone'
        ));
    }
}
