<?php

namespace App\Http\Controllers\AdminToko;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\KepalaToko\BrandRequest;
use App\Imports\BrandImport;

class MasterMerekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::paginate(10);
        $brands_count = Brand::all()->count();
        return view('pages/admintoko/master/merek', compact('brands', 'brands_count'));
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
    public function store(BrandRequest $request)
    {
        $data = $request->all();

        Brand::create($data);

        return redirect()->route('admin-master-merek.index');
    }

    public function import(Request $request)
    {
        $data = $request->file('file');
        $namafile = $data->getClientOriginalName();
        $data->move('BrandData', $namafile);
        Excel::import(new BrandImport, \public_path('/BrandData/' . $namafile));
        return redirect()->route('admin-master-merek.index')->with('success', 'All good!');
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
        $item = Brand::findOrFail($id);

        return view('pages.admintoko.master.merek-edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, $id)
    {
        $data = $request->all();

        $item = Brand::findOrFail($id);

        $item->update($data);

        return redirect()->route('admin-master-merek.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Brand::findOrFail($id);

        $item->delete();

        return redirect()->route('admin-master-merek.index');
    }
}
