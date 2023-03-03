<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class HakAksesController extends Controller
{
    public function index()
    {
        return view('pages/hak-akses');
    }
}
