<?php

namespace App\Http\Controllers\Teknisi;

use Carbon\Carbon;
use App\Models\ServiceTransaction;
use App\Http\Controllers\Controller;
use App\Models\TeknisiTarget;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    /**
     * Displays the dashboard screen
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;

        $target = TeknisiTarget::where('users_id', Auth::user()->id)->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)->sum('item');

        $result = ServiceTransaction::where('users_id', Auth::user()->id)
            ->where('is_approve', 'Setuju')
            ->whereYear('tgl_disetujui', $currentYear)
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->get()
            ->count();

        $profitservis = ServiceTransaction::with('serviceaction')
            ->where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereYear('tgl_disetujui', $currentYear)
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->get()
            ->sum('profit');
        $bonusservis = ($profitservis / 100) * Auth::user()->persen;
        $totalbonus = $bonusservis;

        // Ambil data transaksi servis yang memiliki status "Belum cek"
        $transactions = ServiceTransaction::where('status_servis', 'Belum cek')->get();

        // Cek apakah ada transaksi yang lebih dari 7 hari dari data dibuat
        $currentDate = Carbon::now();
        $reminderThreshold = 7; // Jumlah hari sebelum pengingat ditampilkan
        $reminders = $transactions->filter(function ($transaction) use ($currentDate, $reminderThreshold) {
            return $transaction->created_at->addDays($reminderThreshold)->isPast();
        })->count();

        if ($target != 0) {
            $reward = $totalbonus * (($result / $target) * 100) / 100;
        } else {
            $reward = 0; // Atau nilai default lainnya
        }

        return view('pages/teknisi/dashboard', compact(
            'totalbonus',
            'reminders',
            'target',
            'result',
            'reward'
        ));
    }
}
