<?php

namespace App\Http\Controllers\AdminToko;

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
        $users = User::where('role', 'Teknisi')->get();
        $sales = User::where('role', 'Sales')->get();
        $service_actions = ServiceAction::all();
        $products = Product::whereHas('subCategory', function ($query) {
            $query->whereHas('category', function ($subQuery) {
                $subQuery->where('category_name', 'Sparepart');
            });
        })->where('stok', '>=', 1)->get();

        return view('pages.admintoko.transaksi-servis-bisadiambil', [
            'item' => $item,
            'users' => $users,
            'sales' => $sales,
            'service_actions' => $service_actions,
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
        // dd($request->all());
        $item = ServiceTransaction::findOrFail($id);

        if ($request->users_id != null) {
            $persen_teknisi = User::find($request->users_id)->persen;
        } else {
            $persen_teknisi = null;
        }

        if (count($request->service_actions_id) > 1) {
            $tindakan_servis = [];
            foreach ($request->service_actions_id as $key => $servis) {
                $tindakan = $servis ? ServiceAction::find($servis)->nama_tindakan : $request->tindakan_servis[$key];
                array_push($tindakan_servis, $tindakan);
            }
        } elseif (count($request->tindakan_servis) === 1) {
            $tindakan_servis = $request->tindakan_servis[0];
        } else {
            $tindakan_servis = null;
        }

        if ($request->kondisi_servis === "Sudah jadi") {
            $persen_admin = Auth::user()->persen;
        } else {
            $persen_admin = null;
        }

        $modalSparepart = array_sum($request->modal_sparepart);
        $profittransaksi = $request->biaya - $modalSparepart;
        $bagihasil = ($request->biaya - $modalSparepart) / 100;

        if ($request->biaya != null) {
            $biaya = $request->biaya;
        } else {
            $biaya = 0;
        }

        $garansi = Carbon::now();
        if ($request->garansi != null) {
            $expired = $garansi->addDays(
                $request->garansi
            );
        } else {
            $expired = null;
        }

        $expired = [];
        if (count($request->garansi) > 0) {
            foreach ($request->garansi as $val) {
                array_push($expired, Carbon::now()->addDays(
                    $val
                ));
            }
        } else {
            $expired = null;
        }

        // Transaction create
        $item->update([
            'users_id' => $request->users_id,
            'status_servis' => $request->status_servis,
            'tgl_selesai' => $request->tgl_selesai,
            'kondisi_servis' => $request->kondisi_servis,
            'service_actions_id' => $request->service_actions_id[0],
            'products_id' => $request->products_id[0],
            'tindakan_servis' => json_encode($tindakan_servis),
            'modal_sparepart' => $request->modal_sparepart[0],
            'biaya' => $biaya,
            'catatan' => $request->catatan,
            'is_admin_toko' => $request->is_admin_toko,
            'admin_id' => $request->admin_id,
            'persen_admin' => $persen_admin,
            'persen_teknisi' => $persen_teknisi,
            'omzet' => $request->biaya,
            'profit' => $profittransaksi,
            'profittoko' => $profittransaksi - ($bagihasil *= $persen_admin + $persen_teknisi),
            'service_actions' => json_encode($request->service_actions_id),
            'products' => json_encode($request->products_id),
            'biaya_j' => json_encode($request->biaya_servis),
            'modal_j' => json_encode($request->modal_sparepart),
            'garansi' => $request->garansi[0],
            'exp_garansi' => $expired[0],
            'exp_garansi_j' => json_encode($expired),
        ]);

        if (count($request->products_id) > 0) {

            foreach ($request->products_id as $key => $product) {
                if (!$product) continue;

                $spareparts = Product::find($product);
                $spareparts->stok -= 1;
                $spareparts->save();

                // Menambahkan data transaksi produk sparepart
                $nama_pelanggan = Customer::find($item->customers_id)->nama;

                $order = new Order();
                $order->customers_id = $item->customers_id;
                $order->users_id = $request->sales_id[$key];
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
                if ($request->sales_id[$key] != 1) {
                    $persen_sales = User::find($request->sales_id[$key])->persen;
                } else {
                    $persen_sales = null;
                }
                $orderDetail = new OrderDetail();
                $orderDetail->orders_id = $order->id;
                $orderDetail->users_id = $request->sales_id[$key];
                $orderDetail->products_id = $request->products_id[$key];
                $orderDetail->product_name = $spareparts->product_name;
                $orderDetail->quantity = 1;
                $orderDetail->price = $spareparts->harga_jual;
                $orderDetail->total = $spareparts->harga_jual;
                $orderDetail->sub_total = $spareparts->harga_jual;
                $orderDetail->modal = $spareparts->harga_modal;
                $orderDetail->profit = $spareparts->harga_jual - $spareparts->harga_modal;
                $orderDetail->persen_sales = $persen_sales;
                $orderDetail->profit_toko = ($spareparts->harga_jual - $spareparts->harga_modal) - ($spareparts->harga_jual - $spareparts->harga_modal) / 100 * ($persen_sales + Auth::user()->persen);
                $orderDetail->garansi = $expired;
                $orderDetail->is_admin_toko = "Admin";
                $orderDetail->admin_id = Auth::user()->id;
                $orderDetail->persen_admin = Auth::user()->persen;
                $orderDetail->product_discount_amount = 0;
                $orderDetail->save();
            }
        }

        return redirect()->route('admin-transaksi-servis.index');
    }
}
