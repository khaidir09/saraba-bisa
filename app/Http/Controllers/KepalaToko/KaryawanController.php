<?php

namespace App\Http\Controllers\KepalaToko;

use Carbon\Carbon;
use App\Models\Debt;
use App\Models\User;
use App\Models\Budget;
use App\Models\Salary;
use App\Models\Worker;
use Carbon\CarbonInterface;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Http\Requests\KepalaToko\WorkerRequest;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workers = Worker::with('worker_users', 'user');
        $debts = Worker::with('debt')->get();
        return view('pages/kepalatoko/karyawan/index', compact('workers', 'debts'));
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
    public function store(WorkerRequest $request)
    {
        $data = $request->all();

        Worker::create($data);

        return redirect()->route('karyawan.index');
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

    public function cetak($id)
    {
        $items = Worker::findOrFail($id);
        $salaries = Salary::where('workers_id', $id)
            ->whereMonth('created_at', '=', date("m", strtotime(now())))
            ->get();
        $bonus = Salary::where('workers_id', $id)->whereMonth('created_at', '=', date("m", strtotime(now())))
            ->sum('bonus');
        $users = User::find(1);
        $debts = Debt::where('workers_id', $id)
            ->whereMonth('tgl_disetujui', '=', date("m", strtotime(now())))
            ->get();
        $totalkasbon = Debt::where('workers_id', $id)
            ->whereMonth('tgl_disetujui', '=', date("m", strtotime(now())))
            ->sum('total');

        $pdf = PDF::loadView('pages.kepalatoko.karyawan.cetak', [
            'users' => $users,
            'items' => $items,
            'salaries' => $salaries,
            'bonus' => $bonus,
            'debts' => $debts,
            'totalkasbon' => $totalkasbon
        ])->setPaper('a4', 'portrait')->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        return $pdf->stream();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Worker::findOrFail($id);
        $budgets = Budget::all();

        return view('pages.kepalatoko.karyawan.edit', [
            'item' => $item,
            'budgets' => $budgets
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
        $item = Worker::findOrFail($id);

        $data = $request->all();

        $item->update($data);

        return redirect()->route('karyawan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Worker::findOrFail($id);

        $item->delete();

        return redirect()->route('karyawan.index');
    }
}
