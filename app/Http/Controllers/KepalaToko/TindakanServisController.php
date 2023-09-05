<?php

namespace App\Http\Controllers\KepalaToko;

use Illuminate\Http\Request;
use App\Models\ServiceAction;
use App\Http\Controllers\Controller;
use App\Imports\ServiceActionImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TindakanServisExport;
use App\Http\Requests\KepalaToko\ServiceActionRequest;

class TindakanServisController extends Controller
{
    public function index()
    {
        $actions = ServiceAction::paginate(10);
        $actions_count = ServiceAction::all()->count();
        return view('pages/kepalatoko/tindakan-servis', compact('actions', 'actions_count'));
    }

    public function store(ServiceActionRequest $request)
    {
        $data = $request->all();

        ServiceAction::create($data);

        return redirect()->route('tindakan-servis.index');
    }

    public function import(Request $request)
    {
        $data = $request->file('file');
        $namafile = $data->getClientOriginalName();
        $data->move('ServiceActionData', $namafile);
        Excel::import(new ServiceActionImport, \public_path('/ServiceActionData/' . $namafile));
        return redirect()->route('tindakan-servis.index')->with('success', 'All good!');
    }

    public function export()
    {
        return Excel::download(new TindakanServisExport, 'tindakan-servis.xlsx');
    }

    public function edit($id)
    {
        $item = ServiceAction::findOrFail($id);

        return view('pages.kepalatoko.tindakan-servis-edit', [
            'item' => $item
        ]);
    }

    public function update(Request $request, $id)
    {
        $item = ServiceAction::findOrFail($id);

        // Transaction update
        $item->update([
            'nama_tindakan' => $request->nama_tindakan,
            'modal_sparepart' => $request->modal_sparepart,
            'harga_toko' => $request->harga_toko,
            'harga_pelanggan' => $request->harga_pelanggan,
            'garansi' => $request->garansi,
        ]);

        return redirect()->route('tindakan-servis.index');
    }

    public function destroy($id)
    {
        $item = ServiceAction::findOrFail($id);

        if (
            $item->servicetransaction()->exists()
        ) {
            toast('Data Tindakan Servis yang memiliki riwayat transaksi tidak bisa dihapus.', 'error');
            return redirect()->back();
        }

        $item->delete();

        toast('Data Tindakan Servis berhasil dihapus.', 'success');

        return redirect()->route('tindakan-servis.index');
    }
}
