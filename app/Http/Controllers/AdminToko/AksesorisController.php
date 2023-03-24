<?php

namespace App\Http\Controllers\AdminToko;

use App\Exports\AksesorisExport;
use App\Models\Accessory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\KepalaToko\AksesorisRequest;
use App\Imports\AksesorisImport;

class AksesorisController extends Controller
{
    public function index()
    {
        $accessories = Accessory::paginate(10);
        $accessories_count = Accessory::all()->count();
        return view('pages/admintoko/aksesoris/index', compact('accessories', 'accessories_count'));
    }

    public function store(AksesorisRequest $request)
    {
        $data = $request->all();

        Accessory::create($data);

        return redirect()->route('admin-data-aksesoris.index');
    }

    public function import(Request $request)
    {
        $data = $request->file('file');
        $namafile = $data->getClientOriginalName();
        $data->move('AksesorisData', $namafile);
        Excel::import(new AksesorisImport, \public_path('/AksesorisData/' . $namafile));
        return redirect()->route('admin-data-aksesoris.index')->with('success', 'All good!');
    }

    public function export()
    {
        return Excel::download(new AksesorisExport, 'data-aksesori.xlsx');
    }

    public function edit($id)
    {
        $item = Accessory::findOrFail($id);

        return view('pages.admintoko.aksesoris.edit', [
            'item' => $item
        ]);
    }

    public function update(AksesorisRequest $request, $id)
    {
        $data = $request->all();

        $item = Accessory::findOrFail($id);

        $item->update($data);

        return redirect()->route('admin-data-aksesoris.index');
    }

    public function destroy($id)
    {
        $item = Accessory::findOrFail($id);

        $item->delete();

        return redirect()->route('admin-data-aksesoris.index');
    }
}
