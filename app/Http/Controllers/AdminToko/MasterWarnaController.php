<?php

namespace App\Http\Controllers\AdminToko;

use App\Models\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\KepalaToko\ColorRequest;

class MasterWarnaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages/admintoko/master/warna');
    }

    public function deleteSelected(Request $request)
    {
        $selectedIds  = $request->input('selectedIds');

        $hasRelation = Color::whereIn('id', $selectedIds)
            ->where(function ($query) {
                $query->whereHas('product');
            })
            ->exists();

        if ($hasRelation) {
            return response()->json(['message' => 'Data warna yang memiliki riwayat transaksi tidak bisa dihapus.']);
        }

        Color::whereIn('id', $selectedIds)->delete();
        return response()->json(['message' => 'Data warna berhasil dihapus.']);
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
    public function store(ColorRequest $request)
    {
        $data = $request->all();

        Color::create($data);

        return redirect()->route('admin-master-warna.index');
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
        $item = Color::findOrFail($id);

        return view('pages.admintoko.master.warna-edit', [
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
    public function update(ColorRequest $request, $id)
    {
        $data = $request->all();

        $item = Color::findOrFail($id);

        $item->update($data);

        return redirect()->route('admin-master-warna.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Color::findOrFail($id);

        $item->delete();

        toast('Data Warna berhasil dihapus.', 'success');

        return redirect()->route('admin-master-warna.index');
    }
}
