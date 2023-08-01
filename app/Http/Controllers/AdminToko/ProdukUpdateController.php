<?php

namespace App\Http\Controllers\AdminToko;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductUpdate;

class ProdukUpdateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages/admintoko/produk/update');
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
        $namaproduk = Product::find($request->products_id);

        // Create product
        ProductUpdate::create([
            'products_id' => $request->products_id,
            'product_name' => $namaproduk->product_name,
            'stok' => $request->stok
        ]);

        $products = Product::find($request->products_id);
        $products->stok += $request->stok;
        $products->save();

        return redirect()->route('admin-produk-update.index');
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
        $item = ProductUpdate::findOrFail($id);

        $item->delete();

        $products = Product::find($item->products_id);
        $products->stok -= $item->stok;
        $products->save();

        return redirect()->route('admin-produk-update.index');
    }
}
