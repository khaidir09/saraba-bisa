<?php

namespace App\Http\Controllers\KepalaToko;

use App\Models\Expense;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::latest()->paginate(10);
        $expenses_count = Expense::all()->count();
        return view('pages/kepalatoko/pengeluaran/index', compact('expenses', 'expenses_count'));
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
        Expense::create([
            'name' => $request->name,
            'price' => $request->price
        ]);

        return redirect()->route('pengeluaran.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Expense::findOrFail($id);

        return view('pages.kepalatoko.pengeluaran.edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Expense::findOrFail($id);
        // Transaction update
        $item->update([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('pengeluaran.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Expense::findOrFail($id);

        $item->delete();

        return redirect()->route('pengeluaran.index');
    }
}
