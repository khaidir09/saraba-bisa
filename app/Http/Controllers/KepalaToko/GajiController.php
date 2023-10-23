<?php

namespace App\Http\Controllers\KepalaToko;

use App\Models\User;
use App\Models\Salary;
use App\Models\Worker;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GajiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages/kepalatoko/gaji/index');
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
        $user = User::find($request->users_id);
        if ($user->role === 'Teknisi') {
            $hasil = $user->servicetransaction->sum('profit') / 100;
            $hasil *= $user->persen;
            $bonus = $hasil;
        } elseif ($user->role === 'Sales') {
            $bonus = $user->sale->sum('profit') / 100;
            $bonus *= $user->persen;
        } else {
            $bonusadminservis = $user->adminservice->sum('profit') / 100;
            $bonusadminsale = $user->adminsale->sum('profit') / 100;
            $bonus = $bonusadminservis + $bonusadminsale;
            $bonus *= $user->persen;
        }

        Salary::create([
            'name' => $request->name,
            'users_id' => $request->users_id,
            'workers_id' => $request->workers_id,
            'bonus' => $bonus
        ]);

        return redirect()->route('bonus.index');
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
        $item = Salary::with('worker')->findOrFail($id);
        $workers = Worker::all();
        $users = User::whereNot('role', 'Kepala Toko')->get();

        return view('pages.kepalatoko.gaji.edit', [
            'item' => $item,
            'workers' => $workers,
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
        $data = $request->all();

        $item = Salary::findOrFail($id);

        $item->update($data);

        return redirect()->route('bonus.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Salary::findOrFail($id);

        $item->delete();

        return redirect()->route('bonus.index');
    }
}
