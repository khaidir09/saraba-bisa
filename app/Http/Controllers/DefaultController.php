<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ModelSerie;

class DefaultController extends Controller
{
    public function GetModelSerie(Request $request)
    {
        $brands_id = $request->brands_id;
        $allModelSerie = ModelSerie::where('brands_id', $brands_id)->get();
        return response()->json($allModelSerie);
    } // End Mehtod 








}
