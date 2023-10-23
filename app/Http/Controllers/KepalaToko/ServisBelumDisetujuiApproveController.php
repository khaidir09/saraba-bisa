<?php

namespace App\Http\Controllers\KepalaToko;

use Illuminate\Http\Request;
use App\Models\ServiceTransaction;
use App\Http\Controllers\Controller;

class ServisBelumDisetujuiApproveController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = ServiceTransaction::findOrFail($id);

        return view('pages.kepalatoko.servis.belum-disetujui-approve', [
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

        $item = ServiceTransaction::findOrFail($id);

        $item->update($data);

        return redirect()->route('transaksi-servis-belum-disetujui.index');
    }
}
