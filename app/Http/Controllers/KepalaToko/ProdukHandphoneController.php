<?php

namespace App\Http\Controllers\KepalaToko;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\ModelSerie;
use App\Models\StoreSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Capacity;

class ProdukHandphoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages/kepalatoko/produk/handphone');
    }

    public function deleteSelected(Request $request)
    {
        $selectedIds  = $request->input('selectedIds');

        $hasRelation = Product::whereIn('id', $selectedIds)
            ->where(function ($query) {
                $query->whereHas('relasiOrder');
            })
            ->exists();

        if ($hasRelation) {
            return response()->json(['message' => 'Data produk yang memiliki riwayat transaksi tidak bisa dihapus.']);
        }

        Product::whereIn('id', $selectedIds)->delete();
        return response()->json(['message' => 'Data produk berhasil dihapus.']);
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
        $namakategori = Category::find($request->categories_id);

        $merek = Brand::find($request->brands_id);
        $model = ModelSerie::find($request->model_series_id);

        $productName = $merek->name . ' ' . $model->name;

        // Create product
        Product::create([
            'product_name' => $productName,
            'product_code' => $request->product_code,
            'categories_id' => $request->categories_id,
            'category_name' => $namakategori->category_name,
            'brands_id' => $request->brands_id,
            'model_series_id' => $request->model_series_id,
            'capacities_id' => $request->capacities_id,
            'ram' => $request->ram,
            'stok' => $request->stok,
            'stok_minimal' => $request->stok_minimal,
            'harga_modal' => $request->harga_modal,
            'harga_jual' => $request->harga_jual,
            'keterangan' => $request->keterangan,
            'nomor_seri' => $request->nomor_seri,
            'garansi' => $request->garansi,
            'garansi_imei' => $request->garansi_imei,
            'ppn' => $request->ppn
        ]);

        return redirect()->route('handphone.index');
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
        $brands = Brand::all();
        $model_series = ModelSerie::all();
        $capacities = Capacity::all();
        $toko = StoreSetting::find(1);

        return view('pages.kepalatoko.produk.handphone-edit', [
            'item' => $item,
            'brands' => $brands,
            'model_series' => $model_series,
            'capacities' => $capacities,
            'toko' => $toko
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
        $item = Product::findOrFail($id);
        $namakategori = Category::find($request->categories_id);
        $merek = Brand::find($request->brands_id);
        $model = ModelSerie::find($request->model_series_id);

        $productName = $merek->name . ' ' . $model->name;
        // Create product
        $item->update([
            'brands_id' => $request->brands_id,
            'model_series_id' => $request->model_series_id,
            'product_name' => $productName,
            'ram' => $request->ram,
            'capacities_id' => $request->capacities_id,
            'product_code' => $request->product_code,
            'categories_id' => $request->categories_id,
            'category_name' => $namakategori->category_name,
            'stok' => $request->stok,
            'stok_minimal' => $request->stok_minimal,
            'harga_modal' => $request->harga_modal,
            'harga_jual' => $request->harga_jual,
            'keterangan' => $request->keterangan,
            'nomor_seri' => $request->nomor_seri,
            'garansi' => $request->garansi,
            'garansi_imei' => $request->garansi_imei,
            'ppn' => $request->ppn
        ]);

        return redirect()->route('handphone.index');
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

        return redirect()->route('handphone.index');
    }
}
