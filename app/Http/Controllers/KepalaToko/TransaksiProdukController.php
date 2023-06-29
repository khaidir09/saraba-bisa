<?php

namespace App\Http\Controllers\KepalaToko;

use App\Models\Term;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class TransaksiProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jumlah_semua = Order::all()->count();
        $jumlah_lunas = Order::where('due', '0')->count();
        $jumlah_tidaklunas = Order::where('due', '>', '0')->count();

        return view('pages/kepalatoko/produk/transaksi', compact(
            'jumlah_semua',
            'jumlah_lunas',
            'jumlah_tidaklunas'
        ));
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
    public function show($orders_id)
    {
        $order = Order::with('customer')->where('id', $orders_id)->first();

        $orderItem = OrderDetail::with('product')->where('orders_id', $orders_id)->orderBy('id', 'DESC')->get();
        $total = $orderItem->sum('total');
        $subtotal = $orderItem->sum('sub_total');
        return view('pages.kepalatoko.produk.transaksi-detail', compact('order', 'orderItem', 'total', 'subtotal'));
    }

    public function OrderDueAjax($id)
    {
        $orders = Order::findOrFail($id);
        return response()->json($orders);
    } // End Method

    public function UpdateDue(Request $request)
    {

        $id = $request->id;
        $due_amount = $request->due;

        $allorder = Order::findOrFail($id);
        $maindue = $allorder->due;
        $mainpay = $allorder->pay;

        $paid_due = $maindue - $due_amount;
        $paid_pay = $mainpay + $due_amount;

        Order::findOrFail($id)->update([
            'due' => $paid_due,
            'pay' => $paid_pay,
        ]);

        return redirect()->route('transaksi-produk.index');
    } // End Method 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function cetaktermal($orders_id)
    {
        $order = Order::with('customer', 'user')->where('id', $orders_id)->first();
        $orderItem = OrderDetail::with('product')->where('orders_id', $orders_id)->orderBy('id', 'DESC')->get();
        $total = $orderItem->sum('total');
        $subtotal = $orderItem->sum('sub_total');
        $users = User::find(1);

        $persen = 100 - $total / $subtotal * 100;

        $pdf = PDF::loadView('pages.kepalatoko.produk.cetak-termal', [
            'order' => $order,
            'users' => $users,
            'orderItem' => $orderItem,
            'total' => $total,
            'subtotal' => $subtotal,
            'persen' => $persen
        ]);
        return $pdf->stream();
    }

    public function cetakinkjet($orders_id)
    {
        $order = Order::with('customer')->where('id', $orders_id)->first();
        $orderItem = OrderDetail::with('product')->where('orders_id', $orders_id)->orderBy('id', 'DESC')->get();
        $total = $orderItem->sum('total');
        $subtotal = $orderItem->sum('sub_total');
        $users = User::find(1);
        $termpenjualan = Term::find(3);

        $persen = 100 - $total / $subtotal * 100;

        $pdf = PDF::loadView('pages.kepalatoko.produk.lunas-cetak-inkjet', [
            'order' => $order,
            'users' => $users,
            'orderItem' => $orderItem,
            'total' => $total,
            'subtotal' => $subtotal,
            'persen' => $persen,
            'termpenjualan' => $termpenjualan
        ]);
        return $pdf->setPaper('a4', 'landscape')->stream();
    }

    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Order::findOrFail($id);

        $item->delete();

        OrderDetail::where('orders_id', $item->id)->delete();

        return redirect()->route('transaksi-produk.index');
    }
}
