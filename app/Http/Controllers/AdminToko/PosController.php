<?php

namespace App\Http\Controllers\AdminToko;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

class PosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages/admintoko/produk/pos');
    }

    public function addcart(Request $request)
    {
        Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'qty' => $request->qty,
            'price' => $request->price,
            'weight' => 20,
            'options' => [
                'modal' => $request->modal,
                'harga_asli' => $request->harga_asli
            ]
        ]);

        return redirect()->route('admin-pos');
    }

    public function AllItem()
    {
        $product_item = Cart::content();

        return view('pages.admintoko.produk.text_item', compact('product_item'));
    }

    public function CartUpdate(Request $request, $rowId)
    {
        $qty = $request->qty;
        Cart::update($rowId, $qty);

        return redirect()->route('admin-pos');
    }

    public function applyDiscount(Request $request)
    {
        $discount = $request->input('discount');

        // Memperoleh daftar item dalam keranjang
        $cartItems = Cart::content();

        foreach ($cartItems as $cartItem) {
            // Menghitung total harga sebelum diskon
            $totalBeforeDiscount = $cartItem->qty * $cartItem->price;

            // Menghitung jumlah diskon berdasarkan persentase
            $discountAmount = $totalBeforeDiscount * ($discount / 100);

            // Menghitung total harga setelah diskon
            $totalAfterDiscount = $totalBeforeDiscount - $discountAmount;

            // Memperbarui harga item dengan harga setelah diskon
            Cart::update($cartItem->rowId, [
                'price' => $totalAfterDiscount / $cartItem->qty
            ]);
        }

        return redirect()->route('admin-pos');
    }

    public function CartRemove($rowId)
    {
        Cart::remove($rowId);

        return redirect()->route('admin-pos');
    }

    public function CompleteOrder(Request $request)
    {
        $rtotal = $request->sub_total;
        $rpay = $request->pay;
        $mtotal = $rtotal - $rpay;

        $data = array();
        $data['customers_id'] = $request->customers_id;
        $data['users_id'] = $request->users_id;
        $data['order_date'] = $request->order_date;
        $data['total_products'] = $request->total_products;
        $data['sub_total'] = $request->sub_total;

        $data['invoice_no'] = '' . mt_rand(date('Ymd00'), date('Ymd99'));
        $data['payment_method'] = $request->payment_method;
        $data['pay'] = $request->pay;
        $data['due'] = $mtotal;
        $data['created_at'] = Carbon::now();

        $orders_id = Order::insertGetId($data);
        $contents = Cart::content();

        $persen_sales = User::find($request->users_id);

        $pdata = array();
        foreach ($contents as $content) {
            $pdata['orders_id'] = $orders_id;
            $pdata['products_id'] = $content->id;
            $pdata['product_name'] = $content->name;
            $pdata['quantity'] = $content->qty;
            $pdata['price'] = $content->price;
            $pdata['total'] = $content->total;
            $pdata['sub_total'] = $content->options->harga_asli * $content->qty;
            $pdata['modal'] = $content->options->modal * $content->qty;
            $pdata['profit'] = $content->total - ($content->options->modal * $content->qty);
            $pdata['profit_toko'] = ($content->total - ($content->options->modal * $content->qty)) - ($content->total - ($content->options->modal * $content->qty)) / 100 * ($persen_sales->persen + $request->persen_admin);
            $pdata['users_id'] = $request->users_id;
            $pdata['persen_sales'] = $persen_sales->persen;
            $pdata['is_admin_toko'] = $request->is_admin_toko;
            $pdata['persen_admin'] = $request->persen_admin;
            $pdata['created_at'] = Carbon::now();
            $pdata['updated_at'] = Carbon::now();

            OrderDetail::insert($pdata);
        } // end foreach

        // make stock management
        foreach ($contents as $content) {
            $product = Product::where('id', $content->id)->first();
            $product->stok = $product->stok - $content->qty;
            $product->update();
        } // end foreach

        Cart::destroy();

        return redirect()->route('admin-transaksi-produk.index');
    }
}
