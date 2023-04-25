<?php

namespace App\Http\Controllers\KepalaToko;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PhoneTransaction;

class LaporanHandphoneController extends Controller
{
    public function index()
    {
        $phone_transactions = PhoneTransaction::with('customer', 'phone')->orderByDesc('created_at')->get();
        $count = PhoneTransaction::all()->count();
        $omzethari = PhoneTransaction::whereDay('created_at', '=', date("d", strtotime(now())))
            ->get()
            ->sum('omzet');
        $profithari = PhoneTransaction::whereDay('created_at', '=', date("d", strtotime(now())))
            ->get()
            ->sum('profit');
        $omzetbulan = PhoneTransaction::whereMonth('created_at', '=', date("m", strtotime(now())))
            ->get()
            ->sum('omzet');
        $profitbulan = PhoneTransaction::whereMonth('created_at', '=', date("m", strtotime(now())))
            ->get()
            ->sum('profit');
        $omzettahun = PhoneTransaction::whereYear('created_at', '=', date("Y", strtotime(now())))
            ->get()
            ->sum('omzet');
        $profittahun = PhoneTransaction::whereYear('created_at', '=', date("Y", strtotime(now())))
            ->get()
            ->sum('profit');
        return view('pages/kepalatoko/laporan-handphone', compact('phone_transactions', 'count', 'omzethari', 'profithari', 'omzetbulan', 'profitbulan', 'omzettahun', 'profittahun'));
    }
}
