<?php

namespace App\Http\Controllers\KepalaToko;

use App\Models\User;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
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
        $jumlah_tidaklunas = Order::where('due', '!=', '0')->count();

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
        $subtotal = $orderItem->sum('total');
        return view('pages.kepalatoko.produk.transaksi-detail', compact('order', 'orderItem', 'subtotal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function cetakinkjet($orders_id)
    {
        $order = Order::with('customer')->where('id', $orders_id)->first();
        $orderItem = OrderDetail::with('product')->where('orders_id', $orders_id)->orderBy('id', 'DESC')->get();
        $subtotal = $orderItem->sum('total');
        $users = User::find(1);

        $pdf = PDF::loadView('pages.kepalatoko.produk.lunas-cetak-inkjet', [
            'order' => $order,
            'users' => $users,
            'orderItem' => $orderItem,
            'subtotal' => $subtotal
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

        return redirect()->route('transaksi-produk.index');
    }
}
