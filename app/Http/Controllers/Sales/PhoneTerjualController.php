<?php

namespace App\Http\Controllers\Sales;

use App\Models\Phone;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PhoneTerjualController extends Controller
{
    public function index()
    {
        $phones = Phone::paginate(10);
        $phones_count = Phone::where('stok', '1')->count();
        $phones_terjual_count = Phone::where('stok', '0')->count();
        return view('pages/sales/handphone/terjual', compact('phones', 'phones_count', 'phones_terjual_count'));
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
