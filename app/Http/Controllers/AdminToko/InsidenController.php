<?php

namespace App\Http\Controllers\AdminToko;

use App\Models\User;
use App\Models\Incident;
use Illuminate\Http\Request;
use App\Models\ServiceTransaction;
use App\Http\Controllers\Controller;

class InsidenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role', 'Teknisi')->get();
        $incidents = Incident::with('user')->get();
        $incidents_count = Incident::all()->count();
        $total_incidents = Incident::all()->sum('price');
        $total_danabackup = ServiceTransaction::where('is_approve', 'Setuju')->get()->sum('danabackup');
        $danabackuptersedia = $total_danabackup - $total_incidents;

        return view('pages/admintoko/insiden', compact('users', 'incidents', 'incidents_count', 'total_incidents', 'total_danabackup', 'danabackuptersedia'));
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
    public function store(Request $request)
    {
        // Transaction create
        Incident::create([
            'name' => $request->name,
            'price' => $request->price,
            'users_id' => $request->users_id
        ]);

        return redirect()->route('admin-insiden.index');
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
        $item = Incident::findOrFail($id);
        $users = User::where('role', 'Teknisi')->get();

        return view('pages.admintoko.insiden-edit', [
            'item' => $item,
            'users' => $users
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
        $item = Incident::findOrFail($id);
        $item->update([
            'name' => $request->name,
            'price' => $request->price,
            'users_id' => $request->users_id
        ]);

        return redirect()->route('admin-insiden.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Incident::findOrFail($id);

        $item->delete();

        return redirect()->route('admin-insiden.index');
    }
}
