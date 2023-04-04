<?php

namespace App\Http\Controllers\AdminToko;

use App\Models\Brand;
use App\Models\Phone;
use App\Models\Capacity;
use App\Models\ModelSerie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\KepalaToko\PhoneRequest;
use App\Imports\HandphoneImport;

class PhoneController extends Controller
{
    public function index()
    {
        return view('pages/admintoko/handphone/index');
    }

    public function store(PhoneRequest $request)
    {
        $data = $request->all();

        Phone::create($data);

        return redirect()->route('admin-data-handphone.index');
    }

    public function import(Request $request)
    {
        $data = $request->file('file');
        $namafile = $data->getClientOriginalName();
        $data->move('HandphoneData', $namafile);
        Excel::import(new HandphoneImport, \public_path('/HandphoneData/' . $namafile));
        return redirect()->route('admin-data-handphone.index')->with('success', 'All good!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $item = Phone::with('brand', 'modelserie')->findOrFail($id);
        $capacities = Capacity::all();
        $brands = Brand::all();
        $model_series = ModelSerie::all();

        return view('pages.admintoko.handphone.edit', [
            'item' => $item,
            'capacities' => $capacities,
            'brands' => $brands,
            'model_series' => $model_series
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $item = Phone::findOrFail($id);

        $item->update($data);

        return redirect()->route('admin-data-handphone.index');
    }

    public function destroy($id)
    {
        $item = Phone::findOrFail($id);

        $item->delete();

        return redirect()->route('admin-data-handphone.index');
    }
}
