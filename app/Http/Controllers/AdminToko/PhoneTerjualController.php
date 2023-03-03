<?php

namespace App\Http\Controllers\AdminToko;

use App\Models\Phone;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\KepalaToko\PhoneRequest;
use App\Models\Brand;
use App\Models\Capacity;
use App\Models\ModelSerie;

class PhoneTerjualController extends Controller
{
    public function index()
    {
        $phones = Phone::paginate(10);
        $phones_count = Phone::where('stok', '1')->count();
        $phones_terjual_count = Phone::where('stok', '0')->count();
        return view('pages/admintoko/handphone/terjual', compact('phones', 'phones_count', 'phones_terjual_count'));
    }

    public function store(PhoneRequest $request)
    {
        $data = $request->all();

        Phone::create($data);

        return redirect()->route('admin-data-handphone.index');
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

        return view('pages.admintoko.handphone.terjual-edit', [
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

        return redirect()->route('admin-phone-terjual.index');
    }

    public function destroy($id)
    {
        $item = Phone::findOrFail($id);

        $item->delete();

        return redirect()->route('admin-phone-terjual.index');
    }
}
