<?php

namespace App\Http\Controllers;

use App\Models\ServiceAction;

class AutoModalSparepartController extends Controller
{
    public function getModal($service_actions_id)
    {
        $action = ServiceAction::find($service_actions_id);
        return response()->json(['modal_sparepart' => $action->modal_sparepart]);
    }
}
