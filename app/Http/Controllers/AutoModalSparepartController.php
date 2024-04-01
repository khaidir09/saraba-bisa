<?php

namespace App\Http\Controllers;

use App\Models\Product;

class AutoModalSparepartController extends Controller
{
    public function getSparepart($products_id)
    {
        $sparepart = Product::find($products_id);
        return response()->json(['modal_sparepart' => $sparepart->harga_modal]);
    }
}
