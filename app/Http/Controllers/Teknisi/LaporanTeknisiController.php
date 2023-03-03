<?php

namespace App\Http\Controllers\Teknisi;

use Illuminate\Http\Request;
use App\Models\ServiceTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LaporanTeknisiController extends Controller
{
    public function index()
    {
        $services = ServiceTransaction::with('serviceaction', 'user')->where('is_approve', 'Setuju')->where('users_id', Auth::user()->id)->orderByDesc('tgl_ambil')->get();
        $services_count = ServiceTransaction::with('serviceaction')->where('is_approve', 'Setuju')->count();
        $servishari = ServiceTransaction::with('serviceaction')
            ->where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereDay('tgl_ambil', '=', date("d", strtotime(now())))
            ->count();
        $profithari = ServiceTransaction::with('serviceaction')
            ->where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereDay('tgl_ambil', '=', date("d", strtotime(now())))
            ->get()
            ->sum('profit');
        $servisbulan = ServiceTransaction::with('serviceaction')
            ->where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereMonth('tgl_ambil', '=', date("m", strtotime(now())))
            ->count();
        $profitbulan = ServiceTransaction::with('serviceaction')
            ->where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereMonth('tgl_ambil', '=', date("m", strtotime(now())))
            ->get()
            ->sum('profit');
        $servistahun = ServiceTransaction::with('serviceaction')
            ->where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereYear('tgl_ambil', '=', date("Y", strtotime(now())))
            ->count();
        $profittahun = ServiceTransaction::with('serviceaction')
            ->where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereYear('tgl_ambil', '=', date("Y", strtotime(now())))
            ->get()
            ->sum('profit');
        return view('pages/teknisi/laporan-teknisi', compact('services', 'services_count', 'servishari', 'profithari', 'servisbulan', 'profitbulan', 'servistahun', 'profittahun'));
    }
}
