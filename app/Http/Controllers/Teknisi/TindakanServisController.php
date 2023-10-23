<?php

namespace App\Http\Controllers\Teknisi;

use Illuminate\Http\Request;
use App\Models\ServiceAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\KepalaToko\CustomerRequest;
use App\Http\Requests\KepalaToko\ServiceActionRequest;

class TindakanServisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actions = ServiceAction::paginate(10);
        $actions_count = ServiceAction::all()->count();
        return view('pages/teknisi/tindakan-servis', compact('actions', 'actions_count'));
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
    public function store(ServiceActionRequest $request)
    {
        $data = $request->all();

        ServiceAction::create($data);

        return redirect()->route('teknisi-tindakan-servis.index');
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
        $item = ServiceAction::findOrFail($id);

        return view('pages.teknisi.tindakan-servis-edit', [
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
    public function update(ServiceActionRequest $request, $id)
    {
        $data = $request->all();

        $item = ServiceAction::findOrFail($id);

        $item->update($data);

        return redirect()->route('teknisi-tindakan-servis.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = ServiceAction::findOrFail($id);

        $item->delete();

        return redirect()->route('teknisi-tindakan-servis.index');
    }
}
