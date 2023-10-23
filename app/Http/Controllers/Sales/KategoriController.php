<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages/sales/kategori/index');
    }
}
