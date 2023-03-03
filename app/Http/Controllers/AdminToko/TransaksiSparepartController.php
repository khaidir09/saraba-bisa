<?php

namespace App\Http\Controllers\AdminToko;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sparepart;
use App\Models\SparepartTransaction;
use Illuminate\Support\Facades\Auth;

class TransaksiSparepartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spareparts = Sparepart::all();
        return view('pages/admintoko/sparepart/transaksi', compact('spareparts'));
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
        $persen_sales = User::find($request->users_id);
        $profittransaksi = ($request->harga - $request->modal) * ($request->quantity) - ($request->diskon);
        $bagihasil = ($request->harga - $request->modal) / 100 * ($request->quantity) - ($request->diskon) / 100;

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
            'is_admin_toko' => $request->is_admin_toko,
            'persen_admin' => $request->persen_admin,
            'users_id' => $request->users_id,
            'persen_sales' => $persen_sales->persen,
            'omzet' => ($request->harga * $request->quantity) - ($request->diskon),
            'profit' => $profittransaksi,
            'profittoko' => $profittransaksi - ($bagihasil *= $request->persen_admin + $persen_sales->persen)
        ]);

        $spareparts = Sparepart::find($request->spareparts_id);
        $spareparts->stok -= $request->quantity;
        $spareparts->save();

        return redirect()->route('admin-transaksi-sparepart.index');
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
        $users = User::where('role', 'Sales')->get();
        $customers = Customer::all();

        return view('pages.admintoko.sparepart.transaksi-edit', [
            'item' => $item,
            'spareparts' => $spareparts,
            'customers' => $customers,
            'users' => $users
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
        $persen_sales = User::find($request->users_id);
        $profittransaksi = ($request->harga - $request->modal) * ($request->quantity) - ($request->diskon);
        $bagihasil = ($request->harga - $request->modal) / 100 * ($request->quantity) - ($request->diskon) / 100;
        // Transaction update
        $item->update([
            'customers_id' => $request->customers_id,
            'quantity' => $request->quantity,
            'harga' => $request->harga,
            'modal' => $request->modal,
            'diskon' => $request->diskon,
            'cara_pembayaran' => $request->cara_pembayaran,
            'persen_admin' => $request->persen_admin,
            'users_id' => $request->users_id,
            'persen_sales' => $persen_sales->persen,
            'omzet' => ($request->harga * $request->quantity) - ($request->diskon),
            'profit' => $profittransaksi,
            'profittoko' => $profittransaksi - ($bagihasil *= $request->persen_admin + $persen_sales->persen)
        ]);

        return redirect()->route('admin-transaksi-sparepart.index');
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

        return redirect()->route('admin-transaksi-sparepart.index');
    }
}
