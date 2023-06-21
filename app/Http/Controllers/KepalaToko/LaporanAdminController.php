<?php

namespace App\Http\Controllers\KepalaToko;

use Illuminate\Http\Request;
use App\Models\ServiceTransaction;
use App\Http\Controllers\Controller;
use App\Models\AccessoryTransaction;
use App\Models\OrderDetail;
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
        $jumlahpenjualan = OrderDetail::whereMonth('created_at', $currentMonth)
            ->count();
        $profitpenjualan = OrderDetail::whereMonth('created_at', $currentMonth)
            ->sum('profit');

        return view('pages/kepalatoko/laporan-admin', compact(
            'users',
            'biayaservis',
            'jumlahservis',
            'jumlahpenjualan',
            'profitpenjualan'
        ));
    }
}
