<?php

namespace App\Http\Controllers\KepalaToko;

use App\Http\Controllers\Controller;
use App\Models\User;

class LaporanAssemblyController extends Controller
{
    public function index()
    {
        $users = User::with('assembly')
            ->where('role', 'Teknisi')
            ->get();

        return view('pages/kepalatoko/laporan-assembly', compact('users'));
    }
}
