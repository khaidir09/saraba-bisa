<?php

namespace App\Http\Controllers\KepalaToko;

use App\Models\Product;
use App\Models\SubCategory;
use App\Models\StoreSetting;
use Illuminate\Http\Request;
use App\Exports\ProdukExport;
use App\Imports\ProdukImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ProdukTersediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages/kepalatoko/produk/tersedia');
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
        $namakategori = SubCategory::find($request->sub_categories_id);

        if ($request->stok === null) {
            $stok = 1;
        } else {
            $stok = $request->stok;
        }

        // Create product
        Product::create([
            'product_name' => $request->product_name,
            'product_code' => $request->product_code,
            'sub_categories_id' => $request->sub_categories_id,
            'category_name' => $namakategori->name,
            'stok' => $stok,
            'harga_modal' => $request->harga_modal,
            'harga_jual' => $request->harga_jual,
            'keterangan' => $request->keterangan,
            'nomor_seri' => $request->nomor_seri,
            'garansi' => $request->garansi,
            'garansi_imei' => $request->garansi_imei
        ]);

        return redirect()->route('item-tersedia.index');
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
        $item = Product::findOrFail($id);
        $categories = SubCategory::all();
        $toko = StoreSetting::find(1);

        return view('pages.kepalatoko.produk.tersedia-edit', [
            'item' => $item,
            'categories' => $categories,
            'toko' => $toko
        ]);
    }

    public function import(Request $request)
    {
        $data = $request->file('file');
        $namafile = $data->getClientOriginalName();
        $data->move('ProdukData', $namafile);
        Excel::import(new ProdukImport, \public_path('/ProdukData/' . $namafile));
        return redirect()->route('item-tersedia.index')->with('success', 'All good!');
    }

    public function export()
    {
        return Excel::download(new ProdukExport, 'produk.xlsx');
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
        $item = Product::findOrFail($id);
        $namakategori = SubCategory::find($request->sub_categories_id);
        // Create product
        $item->update([
            'product_name' => $request->product_name,
            'product_code' => $request->product_code,
            'sub_categories_id' => $request->sub_categories_id,
            'category_name' => $namakategori->name,
            'stok' => $request->stok,
            'harga_modal' => $request->harga_modal,
            'harga_jual' => $request->harga_jual,
            'keterangan' => $request->keterangan,
            'nomor_seri' => $request->nomor_seri,
            'garansi' => $request->garansi,
            'garansi_imei' => $request->garansi_imei,
            'ppn' => $request->ppn
        ]);

        return redirect()->route('item-tersedia.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Product::findOrFail($id);

        if (
            $item->relasiOrder()->exists()
        ) {
            toast('Data Produk yang memiliki riwayat transaksi tidak bisa dihapus.', 'error');
            return redirect()->back();
        }

        $item->delete();

        toast('Data Produk berhasil dihapus.', 'success');

        return redirect()->route('item-tersedia.index');
    }
}
