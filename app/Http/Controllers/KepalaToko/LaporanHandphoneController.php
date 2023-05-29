<?php

namespace App\Http\Controllers\KepalaToko;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PhoneTransaction;

class LaporanHandphoneController extends Controller
{
    public function index()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $phone_transactions = PhoneTransaction::with('customer', 'phone')->orderByDesc('created_at')->get();
        $count = PhoneTransaction::all()->count();
        $omzethari = PhoneTransaction::whereDate('created_at', today())
            ->get()
            ->sum('omzet');
        $profithari = PhoneTransaction::whereDate('created_at', today())
            ->get()
            ->sum('profit');
        $omzetbulan = PhoneTransaction::whereMonth('created_at', $currentMonth)
            ->get()
            ->sum('omzet');
        $profitbulan = PhoneTransaction::whereMonth('created_at', $currentMonth)
            ->get()
            ->sum('profit');
        $omzettahun = PhoneTransaction::whereYear('created_at', $currentYear)
            ->get()
            ->sum('omzet');
        $profittahun = PhoneTransaction::whereYear('created_at', $currentYear)
            ->get()
            ->sum('profit');
        return view('pages/kepalatoko/laporan-handphone', compact('phone_transactions', 'count', 'omzethari', 'profithari', 'omzetbulan', 'profitbulan', 'omzettahun', 'profittahun'));
    }
}
