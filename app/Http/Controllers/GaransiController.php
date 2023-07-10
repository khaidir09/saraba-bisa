<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\OrderDetail;

class GaransiController extends Controller
{
    public function index()
    {
        return view('pages/garansi');
    }

    public function data()
    { {
            $product_transactions = OrderDetail::with('order', 'product')->whereHas('order', function ($order) {
                $order->where('invoice_no', $_GET['invoice_no']);
            })->get();
            $users = User::find(1);
            return view('pages/garansi-data', compact('product_transactions', 'users'));
        }
    }
}
