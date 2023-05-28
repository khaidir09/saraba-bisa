<?php

namespace App\Http\Controllers\Teknisi;

use Illuminate\Http\Request;
use App\Models\Assembly;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LaporanAssemblyController extends Controller
{
    public function index()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $assemblies = Assembly::with('user')->where('is_approve', 'Setuju')->where('users_id', Auth::user()->id)->orderByDesc('created_at')->get();
        $assemblies_count = Assembly::with('user')->where('is_approve', 'Setuju')->count();
        $assemblyhari = Assembly::with('user')
            ->where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereDate('tgl_disetujui', today())
            ->count();
        $bonushari = Assembly::with('user')
            ->where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereDate('tgl_disetujui', today())
            ->get()
            ->sum('biaya');
        $assemblybulan = Assembly::with('user')
            ->where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->count();
        $bonusbulan = Assembly::with('user')
            ->where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->get()
            ->sum('biaya');
        $assemblytahun = Assembly::with('user')
            ->where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereYear('tgl_disetujui', $currentYear)
            ->count();
        $bonustahun = Assembly::with('user')
            ->where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereYear('tgl_disetujui', $currentYear)
            ->get()
            ->sum('biaya');
        return view('pages/teknisi/laporan-assembly', compact('assemblies', 'assemblies_count', 'assemblyhari', 'bonushari', 'assemblybulan', 'bonusbulan', 'assemblytahun', 'bonustahun'));
    }
}
