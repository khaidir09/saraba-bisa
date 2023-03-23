<?php

namespace App\Http\Controllers\AdminToko;

use Illuminate\Http\Request;
use App\Models\ServiceAction;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\KepalaToko\ServiceActionRequest;
use App\Imports\ServiceActionImport;

class TindakanServisController extends Controller
{
    public function index()
    {
        $actions = ServiceAction::paginate(10);
        $actions_count = ServiceAction::all()->count();
        return view('pages/admintoko/tindakan-servis', compact('actions', 'actions_count'));
    }

    public function store(ServiceActionRequest $request)
    {
        $data = $request->all();

        ServiceAction::create($data);

        return redirect()->route('admin-tindakan-servis.index');
    }

    public function import(Request $request)
    {
        $data = $request->file('file');
        $namafile = $data->getClientOriginalName();
        $data->move('ServiceActionData', $namafile);
        Excel::import(new ServiceActionImport, \public_path('/ServiceActionData/' . $namafile));
        return redirect()->route('admin-tindakan-servis.index')->with('success', 'All good!');
    }

    public function edit($id)
    {
        $item = ServiceAction::findOrFail($id);

        return view('pages.admintoko.tindakan-servis-edit', [
            'item' => $item
        ]);
    }

    public function update(ServiceActionRequest $request, $id)
    {
        $data = $request->all();

        $item = ServiceAction::findOrFail($id);

        $item->update($data);

        return redirect()->route('admin-tindakan-servis.index');
    }

    public function destroy($id)
    {
        $item = ServiceAction::findOrFail($id);

        $item->delete();

        return redirect()->route('admin-tindakan-servis.index');
    }
}
