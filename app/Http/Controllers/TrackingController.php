<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('pages/tracking', compact('customers'));
    }
}
