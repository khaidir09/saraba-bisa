<?php

namespace App\Http\Controllers\KepalaToko;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
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
        return view('pages/kepalatoko/produk/pos');
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
                'modal' => $request->modal
            ]
        ]);

        return redirect()->route('pos');
    }

    public function AllItem()
    {
        $product_item = Cart::content();

        return view('pages.kepalatoko.produk.text_item', compact('product_item'));
    }

    public function CartUpdate(Request $request, $rowId)
    {
        $qty = $request->qty;
        Cart::update($rowId, $qty);

        return redirect()->route('pos');
    }

    public function CartRemove($rowId)
    {
        Cart::remove($rowId);

        return redirect()->route('pos');
    }

    public function CreateInvoice(Request $request)
    {
        $invoice = '' . mt_rand(date('Ymd00'), date('Ymd99'));

        $user = User::find(1);
        $contents = Cart::content();
        $cust_id = $request->customers_id;
        $no_invoice = $invoice;
        $customer = Customer::where('id', $cust_id)->first();
        return view('pages.kepalatoko.produk.invoice', compact('contents', 'customer', 'user', 'no_invoice'));
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

        $pdata = array();
        foreach ($contents as $content) {
            $pdata['orders_id'] = $orders_id;
            $pdata['products_id'] = $content->id;
            $pdata['product_name'] = $content->name;
            $pdata['quantity'] = $content->qty;
            $pdata['price'] = $content->price;
            $pdata['total'] = $content->total;
            $pdata['modal'] = $content->options->modal * $content->qty;
            $pdata['profit'] = $content->total - ($content->options->modal * $content->qty);
            $pdata['created_at'] = Carbon::now();
            $pdata['updated_at'] = Carbon::now();

            $insert = OrderDetail::insert($pdata);
        } // end foreach

        // make stock management
        foreach ($contents as $content) {
            $product = Product::where('id', $content->id)->first();
            $product->stok = $product->stok - $content->qty;
            $product->update();
        } // end foreach

        Cart::destroy();

        return redirect()->route('transaksi-produk.index');
    }
}
