<?php

namespace App\Http\Controllers\KepalaToko;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sparepart;
use App\Models\SparepartTransaction;

class TransaksiSparepartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spareparts = Sparepart::where('stok', '>=', '1')->get();
        return view('pages/kepalatoko/sparepart/transaksi', compact('spareparts'));
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
        $nomor_transaksi = 'SP-' . mt_rand(date('Ymd00'), date('Ymd99'));
        $profittransaksi = ($request->harga - $request->modal) * ($request->quantity) - ($request->diskon);

        // Transaction create
        SparepartTransaction::create([
            'nomor_transaksi' => $nomor_transaksi,
            'customers_id' => $request->customers_id,
            'spareparts_id' => $request->spareparts_id,
            'quantity' => $request->quantity,
            'harga' => $request->harga,
            'modal' => $request->modal,
            'diskon' => $request->diskon,
            'cara_pembayaran' => $request->cara_pembayaran,
            'omzet' => ($request->harga * $request->quantity) - ($request->diskon),
            'profit' => $profittransaksi
        ]);

        $spareparts = Sparepart::find($request->spareparts_id);
        $spareparts->stok -= $request->quantity;
        $spareparts->save();

        return redirect()->route('transaksi-sparepart.index');
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
        $item = SparepartTransaction::findOrFail($id);
        $spareparts = Sparepart::all();
        $customers = Customer::all();

        return view('pages.kepalatoko.sparepart.transaksi-edit', [
            'item' => $item,
            'spareparts' => $spareparts,
            'customers' => $customers
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
        $item = SparepartTransaction::findOrFail($id);
        $profittransaksi = ($request->harga - $request->modal) * ($request->quantity) - ($request->diskon);
        // Transaction update
        $item->update([
            'customers_id' => $request->customers_id,
            'quantity' => $request->quantity,
            'harga' => $request->harga,
            'modal' => $request->modal,
            'diskon' => $request->diskon,
            'cara_pembayaran' => $request->cara_pembayaran,
            'omzet' => ($request->harga * $request->quantity) - ($request->diskon),
            'profit' => $profittransaksi
        ]);

        return redirect()->route('transaksi-sparepart.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = SparepartTransaction::findOrFail($id);

        $item->delete();

        return redirect()->route('transaksi-sparepart.index');
    }
}
