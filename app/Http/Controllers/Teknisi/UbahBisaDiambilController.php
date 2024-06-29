<?php

namespace App\Http\Controllers\Teknisi;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Models\ServiceAction;
use App\Models\ServiceTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UbahBisaDiambilController extends Controller
{
    public function edit($id)
    {
        $item = ServiceTransaction::findOrFail($id);
        $service_actions = ServiceAction::all();
        $sales = User::where('role', 'Sales')->get();
        $products = Product::whereHas('subCategory', function ($query) {
            $query->whereHas('category', function ($subQuery) {
                $subQuery->where('category_name', 'Sparepart');
            });
        })->where('stok', '>=', 1)->get();

        return view('pages.teknisi.transaksi-servis-bisadiambil', [
            'item' => $item,
            'service_actions' => $service_actions,
            'sales' => $sales,
            'products' => $products
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
        $item = ServiceTransaction::findOrFail($id);

        if ($request->kondisi_servis === "Sudah jadi") {
            $persen_teknisi = Auth::user()->persen;
        } else {
            $persen_teknisi = null;
        }

        if ($request->service_actions_id != null) {
            $tindakan_servis = ServiceAction::find($request->service_actions_id)->nama_tindakan;
        } elseif ($request->tindakan_servis != null) {
            $tindakan_servis = $request->tindakan_servis;
        } else {
            $tindakan_servis = null;
        }

        $profittransaksi = $request->biaya - $request->modal_sparepart;
        $bagihasil = ($request->biaya - $request->modal_sparepart) / 100;
        // Transaction create
        $item->update([
            'users_id' => Auth::user()->id,
            'status_servis' => $request->status_servis,
            'tgl_selesai' => $request->tgl_selesai,
            'kondisi_servis' => $request->kondisi_servis,
            'service_actions_id' => $request->service_actions_id,
            'products_id' => $request->products_id,
            'tindakan_servis' => $tindakan_servis,
            'modal_sparepart' => $request->modal_sparepart,
            'biaya' => $request->biaya,
            'catatan' => $request->catatan,
            'persen_teknisi' => $persen_teknisi,
            'omzet' => $request->biaya,
            'profit' => $profittransaksi,
            'profittoko' => $profittransaksi - ($bagihasil *= $persen_teknisi)
        ]);

        if ($request->products_id != null) {
            $spareparts = Product::find($request->products_id);
            $spareparts->stok -= 1;
            $spareparts->save();

            // Menambahkan data transaksi produk sparepart
            $nama_pelanggan = Customer::find($item->customers_id)->nama;
            $order = new Order();
            $order->customers_id = $item->customers_id;
            $order->users_id = $request->sales_id;
            $order->order_date = Carbon::today()->locale('id')->translatedFormat('d F Y');
            $order->total_products = 1;
            $order->sub_total = $spareparts->harga_jual;
            $order->invoice_no = '' . mt_rand(date('Ymd00'), date('Ymd99'));
            $order->nama_pelanggan = $nama_pelanggan;
            $order->payment_method = "Tunai";
            $order->pay = $spareparts->harga_jual;
            $order->due = 0;
            $order->save();

            // Menambahkan data detail transaksi produk sparepart
            $garansi = Carbon::now();
            if (
                $spareparts->garansi != null
            ) {
                $expired = $garansi->addDays(
                    $spareparts->garansi
                );
            } else {
                $expired = null;
            }
            $persen_sales = User::find($request->sales_id)->persen;
            $orderDetail = new OrderDetail();
            $orderDetail->orders_id = $order->id;
            $orderDetail->users_id = $request->sales_id;
            $orderDetail->products_id = $request->products_id;
            $orderDetail->product_name = $spareparts->product_name;
            $orderDetail->quantity = 1;
            $orderDetail->price = $spareparts->harga_jual;
            $orderDetail->total = $spareparts->harga_jual;
            $orderDetail->sub_total = $spareparts->harga_jual;
            $orderDetail->modal = $spareparts->harga_modal;
            $orderDetail->profit = $spareparts->harga_jual - $spareparts->harga_modal;
            $orderDetail->persen_sales = $persen_sales;
            $orderDetail->profit_toko = ($spareparts->harga_jual - $spareparts->harga_modal) - ($spareparts->harga_jual - $spareparts->harga_modal) / 100 * $persen_sales;
            $orderDetail->garansi = $expired;
            $orderDetail->save();
        }

        return redirect()->route('teknisi-transaksi-servis.index');
    }
}
