<?php

namespace App\Http\Controllers\KepalaToko;

use App\Http\Controllers\Controller;
use App\Models\User;

class LaporanAdminController extends Controller
{
    public function index()
    {
        $users = User::with('adminservice', 'adminsale')->where('role', 'Admin Toko')
            ->get();

        return view('pages/kepalatoko/laporan-admin', compact(
            'users'
        ));
    }
}
