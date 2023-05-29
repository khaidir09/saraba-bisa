<?php

namespace App\Http\Controllers\KepalaToko;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
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
            'options' => ['size' => 'large']
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
        $contents = Cart::content();
        $cust_id = $request->customers_id;
        $customer = Customer::where('id', $cust_id)->first();
        return view('pages.kepalatoko.produk.invoice', compact('contents', 'customer'));
    }
}
