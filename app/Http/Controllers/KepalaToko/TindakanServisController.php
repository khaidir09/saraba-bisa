<?php

namespace App\Http\Controllers\KepalaToko;

use App\Models\ServiceAction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\KepalaToko\ServiceActionRequest;

class TindakanServisController extends Controller
{
    public function index()
    {
        $actions = ServiceAction::paginate(10);
        $actions_count = ServiceAction::all()->count();
        return view('pages/kepalatoko/tindakan-servis', compact('actions', 'actions_count'));
    }

    public function store(ServiceActionRequest $request)
    {
        $data = $request->all();

        ServiceAction::create($data);

        return redirect()->route('tindakan-servis.index');
    }

    public function edit($id)
    {
        $item = ServiceAction::findOrFail($id);

        return view('pages.kepalatoko.tindakan-servis-edit', [
            'item' => $item
        ]);
    }

    public function update(ServiceActionRequest $request, $id)
    {
        $data = $request->all();

        $item = ServiceAction::findOrFail($id);

        $item->update($data);

        return redirect()->route('tindakan-servis.index');
    }

    public function destroy($id)
    {
        $item = ServiceAction::findOrFail($id);

        $item->delete();

        return redirect()->route('tindakan-servis.index');
    }
}
