<?php

namespace App\Http\Controllers\KepalaToko;

use App\Models\Term;
use App\Models\Type;
use App\Models\User;
use App\Models\Brand;
use App\Models\Worker;
use App\Models\Capacity;
use App\Models\Customer;
use App\Models\ModelSerie;
use Illuminate\Http\Request;
use App\Models\ServiceAction;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ServiceTransaction;
use App\Http\Controllers\Controller;

class SudahDiambilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages/kepalatoko/sudah-diambil');
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
        $nomor_servis = '' . mt_rand(date('Ymd00'), date('Ymd99'));

        // Transaction create
        ServiceTransaction::create([
            'nomor_servis' => $nomor_servis,
            'customers_id' => $request->customers_id,
            'types_id' => $request->types_id,
            'brands_id' => $request->brands_id,
            'model_series_id' => $request->model_series_id,
            'imei' => $request->imei,
            'warna' => $request->warna,
            'capacities_id' => $request->capacities_id,
            'kelengkapan' => $request->kelengkapan,
            'kerusakan' => $request->kerusakan,
            'qc_masuk' => $request->qc_masuk,
            'estimasi_pengerjaan' => $request->estimasi_pengerjaan,
            'estimasi_biaya' => $request->estimasi_biaya,
            'uang_muka' => $request->uang_muka,
            'status_servis' => $request->status_servis
        ]);

        return redirect()->route('transaksi-servis.index');
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

    public function cetakinkjet($id)
    {
        $items = ServiceTransaction::findOrFail($id);
        $users = User::find(1);
        $terms = Term::find(2);

        $pdf = PDF::loadView('pages.kepalatoko.notapengambilan-cetak-inkjet', [
            'users' => $users,
            'items' => $items,
            'terms' => $terms,
        ]);
        return $pdf->setOption(['dpi' => 300])->stream();
    }

    public function pengambilantermal($id)
    {
        $items = ServiceTransaction::findOrFail($id);
        $users = User::find(1);

        $pdf = PDF::loadView('pages.kepalatoko.cetak-termal-pengambilan', [
            'users' => $users,
            'items' => $items,
        ]);
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
        $item = ServiceTransaction::findOrFail($id);
        $customers = Customer::all();
        $types = Type::all();
        $brands = Brand::all();
        $model_series = ModelSerie::all();
        $service_actions = ServiceAction::all();
        $capacities = Capacity::all();

        return view('pages.kepalatoko.sudah-diambil-edit', [
            'item' => $item,
            'types' => $types,
            'customers' => $customers,
            'brands' => $brands,
            'model_series' => $model_series,
            'service_actions' => $service_actions,
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
        $item = ServiceTransaction::findOrFail($id);
        $profittransaksi = $request->biaya - $request->modal_sparepart - $request->diskon;
        $nama_pelanggan = Customer::find($request->customers_id);

        if ($request->service_actions_id != null) {
            $tindakan_servis = ServiceAction::find($request->service_actions_id)->nama_tindakan;
        } else {
            $tindakan_servis = null;
        }

        // Transaction create
        $item->update([
            'created_at' => $request->created_at,
            'customers_id' => $request->customers_id,
            'nama_pelanggan' => $nama_pelanggan->nama,
            'types_id' => $request->types_id,
            'brands_id' => $request->brands_id,
            'model_series_id' => $request->model_series_id,
            'kerusakan' => $request->kerusakan,
            'qc_masuk' => $request->qc_masuk,
            'qc_keluar' => $request->qc_keluar,
            'kondisi_servis' => $request->kondisi_servis,
            'service_actions_id' => $request->service_actions_id,
            'tindakan_servis' => $tindakan_servis,
            'modal_sparepart' => $request->modal_sparepart,
            'biaya' => $request->biaya,
            'diskon' => $request->diskon,
            'uang_muka' => $request->uang_muka,
            'cara_pembayaran' => $request->cara_pembayaran,
            'exp_garansi' => $request->exp_garansi,
            'tgl_ambil' => $request->tgl_ambil,
            'pengambil' => $request->pengambil,
            'omzet' => $request->biaya - $request->diskon,
            'profit' => $profittransaksi
        ]);

        return redirect()->route('transaksi-servis-sudah-diambil.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = ServiceTransaction::findOrFail($id);

        $item->delete();

        return redirect()->route('transaksi-servis-sudah-diambil.index');
    }
}
