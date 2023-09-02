<?php

namespace App\Http\Controllers;

use App\Models\ServiceAction;

class AutoBiayaServisController extends Controller
{
    public function getAction($service_actions_id)
    {
        $action = ServiceAction::find($service_actions_id);
        return response()->json(['biaya' => $action->harga_pelanggan]);
    }
}
