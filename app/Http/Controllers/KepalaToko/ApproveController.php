<?php

namespace App\Http\Controllers\KepalaToko;

use App\Models\Type;
use App\Models\Brand;
use App\Models\Capacity;
use App\Models\Customer;
use App\Models\ModelSerie;
use Illuminate\Http\Request;
use App\Models\ServiceAction;
use App\Models\ServiceTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\Node\Query\AndExpr;

class ApproveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = ServiceTransaction::findOrFail($id);

        return view('pages.kepalatoko.servis.transaksi-servis-approve', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $item = ServiceTransaction::findOrFail($id);

        $item->update($data);

        return redirect()->route('transaksi-servis-sudah-diambil.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
