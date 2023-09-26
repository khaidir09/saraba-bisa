<?php

namespace App\Http\Controllers\AdminToko;

use App\Http\Controllers\Controller;
use App\Http\Requests\KepalaToko\CapacityRequest;
use App\Models\Capacity;
use Illuminate\Http\Request;

class MasterKapasitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $capacities = Capacity::paginate(10);
        $capacities_count = Capacity::all()->count();
        return view('pages/admintoko/master/kapasitas', compact('capacities', 'capacities_count'));
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
    public function store(CapacityRequest $request)
    {
        $data = $request->all();

        Capacity::create($data);

        return redirect()->route('admin-master-kapasitas.index');
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
        $item = Capacity::findOrFail($id);

        return view('pages.admintoko.master.kapasitas-edit', [
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
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $item = Capacity::findOrFail($id);

        $item->update($data);

        return redirect()->route('admin-master-kapasitas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Capacity::findOrFail($id);

        if (
            $item->relasiService()->exists()
        ) {
            toast('Data Kapasitas yang memiliki riwayat transaksi tidak bisa dihapus.', 'error');
            return redirect()->back();
        }

        $item->delete();

        toast('Data Kapasitas berhasil dihapus.', 'success');

        return redirect()->route('admin-master-kapasitas.index');
    }
}
