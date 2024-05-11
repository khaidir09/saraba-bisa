<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('pages/payment', compact('user'));
    }
}
