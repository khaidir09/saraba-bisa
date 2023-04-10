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
        $assemblies = Assembly::with('user')->where('is_approve', 'Setuju')->where('users_id', Auth::user()->id)->orderByDesc('created_at')->get();
        $assemblies_count = Assembly::with('user')->where('is_approve', 'Setuju')->count();
        $assemblyhari = Assembly::with('user')
            ->where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereDay('tgl_disetujui', '=', date("d", strtotime(now())))
            ->count();
        $bonushari = Assembly::with('user')
            ->where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereDay('tgl_disetujui', '=', date("d", strtotime(now())))
            ->get()
            ->sum('biaya');
        $assemblybulan = Assembly::with('user')
            ->where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereMonth('tgl_disetujui', '=', date("m", strtotime(now())))
            ->count();
        $bonusbulan = Assembly::with('user')
            ->where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereMonth('tgl_disetujui', '=', date("m", strtotime(now())))
            ->get()
            ->sum('biaya');
        $assemblytahun = Assembly::with('user')
            ->where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereYear('tgl_disetujui', '=', date("Y", strtotime(now())))
            ->count();
        $bonustahun = Assembly::with('user')
            ->where('is_approve', 'Setuju')
            ->where('users_id', Auth::user()->id)
            ->whereYear('tgl_disetujui', '=', date("Y", strtotime(now())))
            ->get()
            ->sum('biaya');
        return view('pages/teknisi/laporan-assembly', compact('assemblies', 'assemblies_count', 'assemblyhari', 'bonushari', 'assemblybulan', 'bonusbulan', 'assemblytahun', 'bonustahun'));
    }
}
