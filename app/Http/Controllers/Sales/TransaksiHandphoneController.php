<?php

namespace App\Http\Controllers\Sales;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Brand;
use App\Models\Phone;
use App\Models\Capacity;
use App\Models\Customer;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ModelSerie;
use Illuminate\Http\Request;
use App\Models\PhoneTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransaksiHandphoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $phones = Phone::all();
        return view('pages/sales/handphone/transaksi', compact('phones'));
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
        $nomor_transaksi = 'HP-' . mt_rand(date('Ymd00'), date('Ymd99'));
        $profittransaksi = $request->harga - $request->modal - $request->diskon;
        $bagihasil = ($request->harga - $request->modal) / 100 - ($request->diskon) / 100;

        $garansi = Carbon::now();
        if ($request->garansi != null) {
            $expired = $garansi->addDays(
                $request->garansi
            );
        } else {
            $expired = null;
        }

        $garansi_imei = Carbon::now();
        if ($request->garansi_imei != null) {
            $expired_imei = $garansi_imei->addDays(
                $request->garansi_imei
            );
        } else {
            $expired_imei = null;
        }

        // Transaction create
        PhoneTransaction::create([
            'nomor_transaksi' => $nomor_transaksi,
            'customers_id' => $request->customers_id,
            'phones_id' => $request->phones_id,
            'quantity' => $request->quantity,
            'qc' => $request->qc,
            'harga' => $request->harga,
            'modal' => $request->modal,
            'diskon' => $request->diskon,
            'cara_pembayaran' => $request->cara_pembayaran,
            'garansi' => $request->garansi,
            'exp_garansi' => $expired,
            'garansi_imei' => $request->garansi_imei,
            'exp_imei' => $expired_imei,
            'persen_sales' => $request->persen_sales,
            'users_id' => Auth::user()->id,
            'omzet' => $request->harga - $request->diskon,
            'profit' => $profittransaksi,
            'profittoko' => $profittransaksi - ($bagihasil *= $request->persen_sales),
        ]);

        $phones = Phone::find($request->phones_id);
        $phones->stok -= $request->quantity;
        $phones->save();

        return redirect()->route('sales-transaksi-handphone.index');
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

    public function cetaktermal($id)
    {
        $items = PhoneTransaction::findOrFail($id);
        $customers = Customer::all();
        $users = User::find(1);

        $pdf = PDF::loadView('pages.sales.handphone.cetak-termal', [
            'users' => $users,
            'items' => $items,
            'customers' => $customers
        ]);
        return $pdf->stream();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = PhoneTransaction::findOrFail($id);
        $phones = Phone::with('brand', 'modelserie')->get();
        $users = User::whereIn('role', ['Kepala Toko', 'Admin', 'Sales'])->get();
        $customers = Customer::all();
        $brands = Brand::all();
        $model_series = ModelSerie::all();
        $capacities = Capacity::all();

        return view('pages.sales.handphone.transaksi-edit', [
            'item' => $item,
            'phones' => $phones,
            'customers' => $customers,
            'brands' => $brands,
            'model_series' => $model_series,
            'capacities' => $capacities,
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
        $item = PhoneTransaction::findOrFail($id);
        $profittransaksi = $request->harga - $request->modal - $request->diskon;
        $bagihasil = ($request->harga - $request->modal) / 100 - ($request->diskon) / 100;
        $item->update([
            'customers_id' => $request->customers_id,
            'qc' => $request->qc,
            'harga' => $request->harga,
            'modal' => $request->modal,
            'diskon' => $request->diskon,
            'cara_pembayaran' => $request->cara_pembayaran,
            'exp_garansi' => $request->exp_garansi,
            'exp_imei' => $request->exp_imei,
            'persen_sales' => $request->persen_sales,
            'users_id' => Auth::user()->id,
            'omzet' => $request->harga - $request->diskon,
            'profit' => $profittransaksi,
            'profittoko' => $profittransaksi - ($bagihasil *= $request->persen_sales),
        ]);

        return redirect()->route('sales-transaksi-handphone.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = PhoneTransaction::findOrFail($id);

        $item->delete();

        return redirect()->route('sales-transaksi-handphone.index');
    }
}
