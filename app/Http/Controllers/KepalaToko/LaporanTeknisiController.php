<?php

namespace App\Http\Controllers\KepalaToko;

use Illuminate\Http\Request;
use App\Models\ServiceTransaction;
use App\Http\Controllers\Controller;
use App\Models\User;

class LaporanTeknisiController extends Controller
{
    public function index()
    {
        $users = User::with('servicetransaction')
            ->where('role', 'Teknisi')
            ->get();


        return view('pages/kepalatoko/laporan-teknisi', compact('users'));
    }
}
