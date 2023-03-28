<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use App\Models\Phone;
use App\Models\PhoneTransaction;
use Illuminate\Http\Request;
use App\Models\ServiceTransaction;

class GaransiController extends Controller
{
    public function index()
    {
        return view('pages/garansi');
    }

    public function data()
    {
        $phone_transaction = PhoneTransaction::with('phone')->whereHas('phone', function ($phone) {
            $phone->where('imei', $_GET['imei']);
        })->get();
        $users = User::find(1);
        return view('pages/garansi-data', compact('phone_transaction', 'users'));
    }
}
