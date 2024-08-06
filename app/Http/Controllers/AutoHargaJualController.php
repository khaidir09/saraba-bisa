<?php

namespace App\Http\Controllers;

use App\Models\Product;

class AutoHargaJualController extends Controller
{
    public function getProduct($products_id)
    {
        $product = Product::find($products_id);
        return response()->json(['price' => $product->harga_jual]);
    }
}
