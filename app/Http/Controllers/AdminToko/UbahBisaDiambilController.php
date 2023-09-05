<?php

namespace App\Http\Controllers\AdminToko;

use App\Models\User;
use App\Models\Product;
use App\Models\StoreSetting;
use Illuminate\Http\Request;
use App\Models\ServiceAction;
use App\Models\ServiceTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UbahBisaDiambilController extends Controller
{
    public function edit($id)
    {
        $item = ServiceTransaction::findOrFail($id);
        $users = User::where('role', 'Teknisi')->get();
        $service_actions = ServiceAction::all();
        $products = Product::whereHas('subCategory', function ($query) {
            $query->where('category_name', 'Sparepart');
        })->where('stok', '>=', '1')->get();

        return view('pages.admintoko.transaksi-servis-bisadiambil', [
            'item' => $item,
            'users' => $users,
            'service_actions' => $service_actions,
            'products' => $products
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
        $item = ServiceTransaction::findOrFail($id);
        $persen_backup = User::find(1);
        if ($request->users_id != null) {
            $persen_teknisi = User::find($request->users_id)->persen;
        } else {
            $persen_teknisi = null;
        }
        if ($request->service_actions_id != null) {
            $tindakan_servis = ServiceAction::find($request->service_actions_id)->nama_tindakan;
        } else {
            $tindakan_servis = null;
        }

        if ($request->kondisi_servis === "Sudah jadi") {
            $persen_admin = Auth::user()->persen;
        } else {
            $persen_admin = null;
        }


        $profittransaksi = $request->biaya - $request->modal_sparepart;
        $bagihasil = ($request->biaya - $request->modal_sparepart) / 100;

        $toko = StoreSetting::find(1);

        if ($toko->is_tax === 1) {
            $ppn = $toko->ppn;
        } else {
            $ppn = null;
        }
        // Transaction create
        $item->update([
            'users_id' => $request->users_id,
            'status_servis' => $request->status_servis,
            'tgl_selesai' => $request->tgl_selesai,
            'kondisi_servis' => $request->kondisi_servis,
            'service_actions_id' => $request->service_actions_id,
            'products_id' => $request->products_id,
            'tindakan_servis' => $tindakan_servis,
            'modal_sparepart' => $request->modal_sparepart,
            'biaya' => $request->biaya,
            'catatan' => $request->catatan,
            'is_admin_toko' => $request->is_admin_toko,
            'admin_id' => $request->admin_id,
            'persen_admin' => $persen_admin,
            'persen_teknisi' => $persen_teknisi,
            'persen_backup' => $persen_backup->persen,
            'omzet' => $request->biaya,
            'profit' => $profittransaksi,
            'profittoko' => $profittransaksi - ($bagihasil *= $persen_admin + $persen_teknisi + $persen_backup->persen),
            'danabackup' => ($request->biaya / 100 - $request->modal_sparepart / 100) * $persen_backup->persen,
            'ppn' => $request->biaya * $ppn / 100,
        ]);

        if ($request->products_id != null) {
            $spareparts = Product::find($request->products_id);
            $spareparts->stok -= 1;
            $spareparts->save();
        }

        return redirect()->route('admin-transaksi-servis.index');
    }
}
