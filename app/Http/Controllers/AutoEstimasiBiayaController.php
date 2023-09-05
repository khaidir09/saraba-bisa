<?php

namespace App\Http\Controllers;

use App\Models\ServiceAction;

class AutoEstimasiBiayaController extends Controller
{
    public function getTindakan($service_actions_id)
    {
        $action = ServiceAction::find($service_actions_id);
        return response()->json(['estimasi_biaya' => $action->harga_pelanggan]);
    }
}
