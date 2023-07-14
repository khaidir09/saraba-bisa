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

class TransaksiServisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $processes = ServiceTransaction::with('customer')->whereNotIn('status_servis', ['Bisa Diambil', 'Sudah Diambil'])->orderByDesc('updated_at')->paginate(10);
        $processes_count = ServiceTransaction::whereNotIn('status_servis', ['Bisa Diambil', 'Sudah Diambil'])->count();
        $bisadiambil = ServiceTransaction::with('customer', 'serviceaction')->where('status_servis', 'Bisa Diambil')->paginate(10);
        $jumlahbisadiambil = ServiceTransaction::with('customer', 'serviceaction')->where('status_servis', 'Bisa Diambil')->count();
        $jumlah_bisa_diambil = ServiceTransaction::where('status_servis', 'Bisa Diambil')->count();
        $jumlah_sudah_diambil = ServiceTransaction::where('status_servis', 'Sudah Diambil')->count();
        $jumlah_semua = ServiceTransaction::all()->count();
        return view('pages/kepalatoko/transaksi-servis', compact(
            'processes',
            'processes_count',
            'jumlah_bisa_diambil',
            'jumlah_sudah_diambil',
            'jumlah_semua',
            'bisadiambil',
            'jumlahbisadiambil'
        ));
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
        $nama_pelanggan = Customer::find($request->customers_id);

        // Transaction create
        ServiceTransaction::create([
            'nomor_servis' => $nomor_servis,
            'customers_id' => $request->customers_id,
            'nama_pelanggan' => $nama_pelanggan->nama,
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
            'status_servis' => $request->status_servis,
            'penerima' => $request->penerima
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
        $item = ServiceTransaction::findOrFail($id);

        return view('pages.kepalatoko.transaksi-servis-status', [
            'item' => $item
        ]);
    }

    public function cetaktermal($id)
    {
        $items = ServiceTransaction::with('customer')->findOrFail($id);
        $customers = Customer::all();
        $types = Type::all();
        $brands = Brand::all();
        $capacities = Capacity::all();
        $model_series = ModelSerie::all();
        $users = User::find(1);

        // Ambil nomor invoice dari database
        $invoiceNumber = $items->nomor_servis;
        $namaPelanggan = $items->customer->nama;

        $pdf = PDF::loadView('pages.kepalatoko.kepalatoko-cetak-termal', [
            'users' => $users,
            'items' => $items,
            'customers' => $customers,
            'types' => $types,
            'brands' => $brands,
            'model_series' => $model_series,
            'capacities' => $capacities
        ]);

        $filename = 'Nota Terima ' . $invoiceNumber . ' ' . '(' . $namaPelanggan . ')' . '.pdf';

        return $pdf->stream($filename);
    }

    public function cetakinkjet($id)
    {
        $items = ServiceTransaction::with('customer')->findOrFail($id);
        $users = User::find(1);
        $terms = Term::find(1);

        // Ambil nomor invoice dari database
        $invoiceNumber = $items->nomor_servis;
        $namaPelanggan = $items->customer->nama;

        $pdf = PDF::loadView('pages.kepalatoko.servis.notaterima-cetak-inkjet', [
            'users' => $users,
            'items' => $items,
            'terms' => $terms
        ]);

        $filename = 'Nota Terima ' . $invoiceNumber . ' ' . '(' . $namaPelanggan . ')' . '.pdf';

        return $pdf->setOption(['dpi' => 300])->stream($filename);
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
        $users = User::where('role', 'Teknisi')->get();
        $workers = Worker::where('jabatan', 'like', '%' . 'teknisi')->get();

        return view('pages.kepalatoko.transaksi-servis-edit', [
            'item' => $item,
            'types' => $types,
            'customers' => $customers,
            'brands' => $brands,
            'model_series' => $model_series,
            'service_actions' => $service_actions,
            'capacities' => $capacities,
            'users' => $users,
            'workers' => $workers
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
        $nama_pelanggan = Customer::find($request->customers_id);

        // Transaction update
        $item->update([
            'created_at' => $request->created_at,
            'customers_id' => $request->customers_id,
            'nama_pelanggan' => $nama_pelanggan->nama,
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
            'uang_muka' => $request->uang_muka
        ]);

        return redirect()->route('transaksi-servis.index');
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

        return redirect()->route('transaksi-servis.index');
    }
}
