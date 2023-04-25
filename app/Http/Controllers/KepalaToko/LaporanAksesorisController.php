<?php

namespace App\Http\Controllers\KepalaToko;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccessoryTransaction;

class LaporanAksesorisController extends Controller
{
    public function index()
    {
        $accessory_transactions = AccessoryTransaction::with('customer', 'accessory')->orderByDesc('created_at')->get();
        $count = AccessoryTransaction::all()->count();
        $omzethari = AccessoryTransaction::whereDay('created_at', '=', date("d", strtotime(now())))
            ->get()
            ->sum('omzet');
        $profithari = AccessoryTransaction::whereDay('created_at', '=', date("d", strtotime(now())))
            ->get()
            ->sum('profit');
        $omzetbulan = AccessoryTransaction::whereMonth('created_at', '=', date("m", strtotime(now())))
            ->get()
            ->sum('omzet');
        $profitbulan = AccessoryTransaction::whereMonth('created_at', '=', date("m", strtotime(now())))
            ->get()
            ->sum('profit');
        $omzettahun = AccessoryTransaction::whereYear('created_at', '=', date("Y", strtotime(now())))
            ->get()
            ->sum('omzet');
        $profittahun = AccessoryTransaction::whereYear('created_at', '=', date("Y", strtotime(now())))
            ->get()
            ->sum('profit');
        return view('pages/kepalatoko/laporan-aksesoris', compact('accessory_transactions', 'count', 'omzethari', 'profithari', 'omzetbulan', 'profitbulan', 'omzettahun', 'profittahun'));
    }
}
