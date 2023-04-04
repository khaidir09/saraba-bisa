<?php

namespace App\Http\Controllers\KepalaToko;

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
        return view('pages/kepalatoko/handphone/terjual');
    }

    public function store(PhoneRequest $request)
    {
        $data = $request->all();

        Phone::create($data);

        return redirect()->route('data-handphone.index');
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

        return view('pages.kepalatoko.handphone.terjual-edit', [
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

        return redirect()->route('phone-terjual.index');
    }

    public function destroy($id)
    {
        $item = Phone::findOrFail($id);

        $item->delete();

        return redirect()->route('phone-terjual.index');
    }
}
