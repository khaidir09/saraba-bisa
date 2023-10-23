<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\ServiceTransaction;

class TrackingController extends Controller
{
    public function index()
    {
        return view('pages/tracking');
    }

    public function data()
    {
        $customers = Customer::where('nomor_hp', $_GET['nomor_hp'])->get('nama');
        $services = ServiceTransaction::with('customer')->whereHas('customer', function ($customer) {
            $customer->where('nomor_hp', $_GET['nomor_hp']);
        })->orderByDesc('created_at')->get();
        $totalbiaya = ServiceTransaction::with('customer')->whereHas('customer', function ($customer) {
            $customer->where('nomor_hp', $_GET['nomor_hp']);
        })->sum('biaya');
        $users = User::find(1);
        return view('pages/tracking-data', compact('services', 'totalbiaya', 'customers', 'users'));
    }
}
