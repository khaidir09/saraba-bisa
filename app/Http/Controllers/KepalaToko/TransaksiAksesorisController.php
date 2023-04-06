<?php

namespace App\Http\Controllers\KepalaToko;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Customer;
use App\Models\Accessory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccessoryTransaction;
use Illuminate\Support\Facades\Auth;

class TransaksiAksesorisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accessories = Accessory::all();
        return view('pages/kepalatoko/aksesoris/transaksi', compact('accessories'));
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
        $nomor_transaksi = 'AC-' . mt_rand(date('Ymd00'), date('Ymd99'));
        $persen_sales = User::find($request->users_id);
        $profittransaksi = ($request->harga - $request->modal) * ($request->quantity) - ($request->diskon);
        $bagihasil = ($request->harga - $request->modal) / 100 * ($request->quantity) - ($request->diskon) / 100;

        $garansi = Carbon::now();
        if ($request->garansi != null) {
            $expired = $garansi->addDays(
                $request->garansi
            );
        } else {
            $expired = null;
        }

        // Transaction create
        AccessoryTransaction::create([
            'nomor_transaksi' => $nomor_transaksi,
            'customers_id' => $request->customers_id,
            'accessories_id' => $request->accessories_id,
            'quantity' => $request->quantity,
            'harga' => $request->harga,
            'modal' => $request->modal,
            'diskon' => $request->diskon,
            'cara_pembayaran' => $request->cara_pembayaran,
            'garansi' => $request->garansi,
            'exp_garansi' => $expired,
            'users_id' => $request->users_id,
            'persen_sales' => $persen_sales->persen,
            'omzet' => ($request->harga * $request->quantity) - ($request->diskon),
            'profit' => $profittransaksi,
            'profittoko' => $profittransaksi - ($bagihasil *= $persen_sales->persen)
        ]);

        $accessories = Accessory::find($request->accessories_id);
        $accessories->stok -= $request->quantity;
        $accessories->save();

        return redirect()->route('transaksi-aksesoris.index');
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
        $item = AccessoryTransaction::findOrFail($id);
        $accessories = Accessory::all();
        $users = User::where('role', 'Sales')->get();
        $customers = Customer::all();

        return view('pages.kepalatoko.aksesoris.transaksi-edit', [
            'item' => $item,
            'accessories' => $accessories,
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
        $item = AccessoryTransaction::findOrFail($id);
        $persen_sales = User::find($request->users_id);
        $profittransaksi = ($request->harga - $request->modal) * ($request->quantity) - ($request->diskon);
        $bagihasil = ($request->harga - $request->modal) / 100 * ($request->quantity) - ($request->diskon) / 100;
        // Transaction create
        $item->update([
            'customers_id' => $request->customers_id,
            'quantity' => $request->quantity,
            'harga' => $request->harga,
            'modal' => $request->modal,
            'diskon' => $request->diskon,
            'cara_pembayaran' => $request->cara_pembayaran,
            'exp_garansi' => $request->exp_garansi,
            'users_id' => $request->users_id,
            'persen_sales' => $persen_sales->persen,
            'omzet' => ($request->harga * $request->quantity) - ($request->diskon),
            'profit' => $profittransaksi,
            'profittoko' => $profittransaksi - ($bagihasil *= $persen_sales->persen)
        ]);

        return redirect()->route('transaksi-aksesoris.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = AccessoryTransaction::findOrFail($id);

        $item->delete();

        return redirect()->route('transaksi-aksesoris.index');
    }
}
