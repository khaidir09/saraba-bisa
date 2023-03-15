<?php

namespace App\Http\Controllers\Sales;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Brand;
use App\Models\Phone;
use App\Models\Capacity;
use App\Models\Customer;
use App\Models\Sparepart;
use App\Models\ModelSerie;
use Illuminate\Http\Request;
use App\Models\PhoneTransaction;
use App\Http\Controllers\Controller;
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
        return view('pages/sales/sparepart/transaksi', compact('spareparts'));
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

    public function ajax(Request $request)
    {
        $phones_id['phones_id'] = $request->phones_id;
        $ajax_handphone = Phone::where('id', $phones_id)->get();

        return view('pages/kepalatoko/handphone/ajax', compact('ajax_handphone'));
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
        SparepartTransaction::create([
            'nomor_transaksi' => $nomor_transaksi,
            'customers_id' => $request->customers_id,
            'spareparts_id' => $request->spareparts_id,
            'quantity' => $request->quantity,
            'harga' => $request->harga,
            'modal' => $request->modal,
            'diskon' => $request->diskon,
            'cara_pembayaran' => $request->cara_pembayaran,
            'garansi' => $request->garansi,
            'exp_garansi' => $expired,
            'users_id' => Auth::user()->id,
            'persen_sales' => $request->persen_sales,
            'omzet' => ($request->harga * $request->quantity) - ($request->diskon),
            'profit' => $profittransaksi,
            'profittoko' => $profittransaksi - ($bagihasil *= $request->persen_sales),
        ]);

        $spareparts = Sparepart::find($request->spareparts_id);
        $spareparts->stok -= $request->quantity;
        $spareparts->save();

        return redirect()->route('sales-transaksi-sparepart.index');
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
        $users = User::whereIn('role', ['Kepala Toko', 'Admin', 'Sales'])->get();
        $customers = Customer::all();

        return view('pages.sales.sparepart.transaksi-edit', [
            'item' => $item,
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
            'exp_garansi' => $request->exp_garansi,
            'users_id' => Auth::user()->id,
            'persen_sales' => $request->persen_sales,
            'omzet' => ($request->harga * $request->quantity) - ($request->diskon),
            'profit' => $profittransaksi,
            'profittoko' => $profittransaksi - ($bagihasil *= $request->persen_sales)
        ]);

        return redirect()->route('sales-transaksi-sparepart.index');
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

        return redirect()->route('sales-transaksi-sparepart.index');
    }
}
