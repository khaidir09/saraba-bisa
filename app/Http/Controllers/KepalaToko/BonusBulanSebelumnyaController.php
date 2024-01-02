<?php

namespace App\Http\Controllers\KepalaToko;

use App\Models\User;
use App\Models\Salary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BonusBulanSebelumnyaController extends Controller
{

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
            $hasil = $user->prevservicetransaction->sum('profit') / 100;
            $hasil *= $user->persen;
            $bonus = $hasil;
        } elseif ($user->role === 'Sales') {
            $bonus = $user->prevsale->sum('profit') / 100;
            $bonus *= $user->persen;
        } else {
            $bonusadminservis = $user->prevadminservice->sum('profit') / 100;
            $bonusadminsale = $user->prevadminsale->sum('profit') / 100;
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
}
