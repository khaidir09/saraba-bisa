<?php

namespace App\Http\Controllers\AdminToko;

use App\Models\User;
use App\Models\Assembly;
use App\Models\Capacity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssemblyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role', 'Teknisi')->get();
        $capacities = Capacity::all();
        $assemblies = Assembly::all();
        return view('pages/admintoko/assembly/index', compact('users', 'assemblies', 'capacities'));
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
        $data = $request->all();

        Assembly::create($data);

        return redirect()->route('admin-assembly.index');
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
        $item = Assembly::with('user')->findOrFail($id);
        $capacities = Capacity::all();
        $users = User::where('role', 'Teknisi')->get();

        return view('pages.admintoko.assembly.edit', [
            'item' => $item,
            'users' => $users,
            'capacities' => $capacities
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

        $item = Assembly::findOrFail($id);

        $item->update($data);

        return redirect()->route('admin-assembly.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Assembly::findOrFail($id);

        $item->delete();

        return redirect()->route('admin-assembly.index');
    }
}
