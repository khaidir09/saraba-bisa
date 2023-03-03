<?php

namespace App\Http\Controllers\AdminToko;

use App\Models\ModelSerie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\KepalaToko\ModelSerieRequest;
use App\Models\Brand;

class MasterModelSeriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = ModelSerie::with('brand')->paginate(10);
        $models_count = ModelSerie::all()->count();
        $brands = Brand::all();
        return view('pages/admintoko/master/model-seri', compact('models', 'models_count', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModelSerieRequest $request)
    {
        $data = $request->all();

        ModelSerie::create($data);

        return redirect()->route('admin-master-model-seri.index');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = ModelSerie::with('brand')->findOrFail($id);
        $brands = Brand::all();

        return view('pages.admintoko.master.model-seri-edit', [
            'item' => $item,
            'brands' => $brands
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ModelSerieRequest $request, $id)
    {
        $data = $request->all();

        $item = ModelSerie::findOrFail($id);

        $item->update($data);

        return redirect()->route('admin-master-model-seri.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = ModelSerie::findOrFail($id);

        $item->delete();

        return redirect()->route('admin-master-model-seri.index');
    }
}
