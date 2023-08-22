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
        $users = User::with('adminservice', 'adminsale')->where('role', 'Admin Toko')
            ->get();

        return view('pages/kepalatoko/laporan-admin', compact(
            'users',
        ));
    }
}
