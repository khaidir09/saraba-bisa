<?php

namespace App\Http\Controllers\KepalaToko;

use Illuminate\Http\Request;
use App\Models\ServiceTransaction;
use App\Http\Controllers\Controller;
use App\Models\User;

class LaporanSalesController extends Controller
{
    public function index()
    {
        $users = User::with('spareparttransaction', 'accessorytransaction', 'phonetransaction')
            ->where('role', 'Sales')
            ->get();


        return view('pages/kepalatoko/laporan-sales', compact('users'));
    }
}
