<?php

namespace App\Http\Controllers\KepalaToko;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Order;
use App\Models\Product;
use App\Models\Capacity;
use App\Models\Customer;
use App\Models\ModelSerie;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Purchase;

class TukarTambahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages/kepalatoko/pembelian/tukar-tambah');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::where('categories_id', '1')->where('stok', '>=', '1')->get();
        $customers = Customer::all();
        $sales = User::where('role', 'Sales')->get();
        $brands = Brand::all();
        $model_series = ModelSerie::all();
        $capacities = Capacity::all();
        $colors = Color::all();
        return view('pages/kepalatoko/pembelian/input-tukar-tambah', compact('customers', 'products', 'sales', 'brands', 'model_series', 'capacities', 'colors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nama_pelanggan = Customer::find($request->customers_id);
        if ($request->payment_method === 'Tunai') {
            $tunai = $request->price;
            $transfer = 0;
        }

        if ($request->payment_method === 'Transfer') {
            $transfer = $request->price;
            $tunai = 0;
        }

        // Create sale
        $sale = Order::create([
            'customers_id' => $request->customers_id,
            'users_id' => $request->users_id,
            'order_date' => $request->order_date,
            'total_products' => 1,
            'sub_total' => $request->price,
            'invoice_no' => '' . mt_rand(date('Ymd00'), date('Ymd99')),
            'nama_pelanggan' => $nama_pelanggan->nama,
            'payment_method' => $request->payment_method,
            'payment_status' => 1,
            'pay' => $request->price,
            'tunai' => $tunai,
            'transfer' => $transfer,
            'due' => 0,
            'is_approve' => 'Setuju',
            'tgl_disetujui' => date('Y-m-d'),
            'note' => 'Tukar Tambah',
        ]);

        $produk_jual = Product::find($request->product_sale_id);

        $garansi = Carbon::now();
        if ($produk_jual->garansi != null) {
            $expired = $garansi->addDays(
                $produk_jual->garansi
            );
        } else {
            $expired = null;
        }

        $garansi_imei = Carbon::now();
        if ($produk_jual->garansi_imei != null) {
            $expired_imei = $garansi_imei->addDays(
                $produk_jual->garansi_imei
            );
        } else {
            $expired_imei = null;
        }
        $persen_sales = User::find($request->users_id);

        // Create sale detail
        OrderDetail::create([
            'orders_id' => $sale->id,
            'users_id' => $request->users_id,
            'products_id' => $request->product_sale_id,
            'product_name' => $produk_jual->product_name,
            'quantity' => 1,
            'garansi' => $expired,
            'garansi_imei' => $expired_imei,
            'price' => $request->price,
            'total' => $request->price,
            'sub_total' => $request->price,
            'product_discount_amount' => 0,
            'modal' => $produk_jual->harga_modal,
            'profit' => $request->price - $produk_jual->harga_modal,
            'profit_toko' => ($request->price - $produk_jual->harga_modal) - ($request->price - $produk_jual->harga_modal) / 100 * $persen_sales->persen,
            'payment_method' => $request->payment_method
        ]);

        $merek = Brand::find($request->brands_id);
        $model = ModelSerie::find($request->model_series_id);

        $productName = $merek->name . ' ' . $model->name;

        // Create product
        $produk = Product::create([
            'product_name' => $productName,
            'nomor_seri' => $request->nomor_seri,
            'categories_id' => 1,
            'brands_id' => $request->brands_id,
            'model_series_id' => $request->model_series_id,
            'category_name' => 'Handphone',
            'warna' => $request->warna,
            'kondisi' => 'Second',
            'ram' => $request->ram,
            'capacities_id' => $request->capacities_id,
            'stok' => 1,
            'harga_modal' => $request->harga_modal,
            'harga_jual' => $request->harga_jual,
            'garansi' => $request->garansi,
            'garansi_imei' => $request->garansi_imei,
            'keterangan' => $request->keterangan,
            'product_code' => $request->product_code
        ]);

        // Create product
        Purchase::create([
            'reference_number' => $sale->invoice_no,
            'customers_id' => $request->customers_id,
            'products_id' => $produk->id,
            'product_name' => $produk->product_name,
            'quantity' => 1,
            'product_price' => $request->harga_modal,
            'total_price' => $request->harga_modal,
            'keterangan' => 'Tukar Tambah',
            'date' => date('Y-m-d')
        ]);

        return redirect()->route('tukar-tambah.index');
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
        $item = Purchase::findOrFail($id);

        $item->delete();

        $products = Product::find($item->products_id);
        if ($products != null) {
            $products->delete();
        }

        return redirect()->back();
    }
}
