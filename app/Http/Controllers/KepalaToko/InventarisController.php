<?php

namespace App\Http\Controllers\KepalaToko;

use Carbon\Carbon;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\KepalaToko\InventoryRequest;

class InventarisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventories = Inventory::latest()->paginate(10);
        $expenses_count = Inventory::all()->count();
        return view('pages/kepalatoko/inventaris/index', compact('inventories', 'expenses_count'));
    }

    public function deleteSelected(Request $request)
    {
        $selectedIds  = $request->input('selectedIds');
        Inventory::whereIn('id', $selectedIds)->delete();
        return response()->json(['message' => 'Data inventaris berhasil dihapus.']);
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
    public function store(InventoryRequest $request)
    {
        $masa_penggantian = Carbon::now();
        $expired = $masa_penggantian->addDays(
            $request->masa_penggantian
        );

        // Transaction create
        Inventory::create([
            'name' => $request->name,
            'price' => $request->price,
            'supplier' => $request->supplier,
            'masa_penggantian' => $expired,
            'created_at' => $request->created_at,
        ]);

        return redirect()->route('inventaris.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Inventory::findOrFail($id);

        return view('pages.kepalatoko.inventaris.approve', [
            'item' => $item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Inventory::findOrFail($id);

        return view('pages.kepalatoko.inventaris.edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Inventory::findOrFail($id);
        // Transaction update
        $item->update([
            'name' => $request->name,
            'price' => $request->price,
            'supplier' => $request->supplier,
            'created_at' => $request->created_at,
            'masa_penggantian' => $request->masa_penggantian,
        ]);

        return redirect()->route('inventaris.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Inventory::findOrFail($id);

        $item->delete();

        return redirect()->route('inventaris.index');
    }
}
