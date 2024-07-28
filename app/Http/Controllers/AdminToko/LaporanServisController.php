<?php

namespace App\Http\Controllers\AdminToko;

use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ServiceTransaction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class LaporanServisController extends Controller
{
    public function index()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $omzethari = ServiceTransaction::with('serviceaction')
            ->where('is_approve', 'Setuju')
            ->whereDate('tgl_disetujui', today())
            ->get()
            ->sum('omzet');
        $profithari = ServiceTransaction::with('serviceaction')
            ->where('is_approve', 'Setuju')
            ->whereDate('tgl_disetujui', today())
            ->get()
            ->sum('profittoko');
        $omzetbulan = ServiceTransaction::with('serviceaction')
            ->where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->get()
            ->sum('omzet');
        $profitbulan = ServiceTransaction::with('serviceaction')
            ->where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth)
            ->get()
            ->sum('profittoko');
        $omzettahun = ServiceTransaction::with('serviceaction')
            ->where('is_approve', 'Setuju')
            ->whereYear('tgl_disetujui', $currentYear)
            ->get()
            ->sum('omzet');
        $profittahun = ServiceTransaction::with('serviceaction')
            ->where('is_approve', 'Setuju')
            ->whereYear('tgl_disetujui', $currentYear)
            ->get()
            ->sum('profittoko');
        return view('pages/admintoko/laporan-servis', compact('omzethari', 'profithari', 'omzetbulan', 'profitbulan', 'omzettahun', 'profittahun'));
    }

    public function cetak(Request $request)
    {
        // Mengambil logo dan nama toko
        $users = User::find(1);

        $logo = $users->profile_photo_path;
        $imagePath = public_path('storage/' . $logo);

        // Filter tanggal
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        // Mengambil data servis
        $services = ServiceTransaction::with('brand', 'modelserie', 'user')->where('status_servis', 'Sudah Diambil')
            ->whereDate('tgl_ambil', '>=', $start_date)
            ->whereDate('tgl_ambil', '<=', $end_date)
            ->orderBy('tgl_ambil', 'asc')
            ->get();

        // Menghitung total item servis
        $total_servis = ServiceTransaction::where('status_servis', 'Sudah Diambil')
            ->whereDate('tgl_ambil', '>=', $start_date)
            ->whereDate('tgl_ambil', '<=', $end_date)
            ->orderBy('tgl_ambil', 'asc')
            ->get()->count();

        // Menghitung total pembayaran tunai
        $total_tunai = ServiceTransaction::where('status_servis', 'Sudah Diambil')
            ->whereDate('tgl_ambil', '>=', $start_date)
            ->whereDate('tgl_ambil', '<=', $end_date)
            ->sum('tunai');

        // Menghitung total pembayaran transfer
        $total_transfer = ServiceTransaction::where('status_servis', 'Sudah Diambil')
            ->whereDate('tgl_ambil', '>=', $start_date)
            ->whereDate('tgl_ambil', '<=', $end_date)
            ->sum('transfer');

        // Menghitung total pembayaran kredit
        $total_kredit = ServiceTransaction::where('status_servis', 'Sudah Diambil')
            ->whereDate('tgl_ambil', '>=', $start_date)
            ->whereDate('tgl_ambil', '<=', $end_date)
            ->sum('due');

        // Mengambil data brand terbanyak
        $topbrands =
            ServiceTransaction::where('status_servis', 'Sudah Diambil')
            ->whereDate('tgl_ambil', '>=', $start_date)
            ->whereDate('tgl_ambil', '<=', $end_date)
            ->select('brands.name as brand_name')
            ->join('brands', 'service_transactions.brands_id', '=', 'brands.id')
            ->groupBy('brand_name')
            ->orderBy(DB::raw('COUNT(*)'), 'desc')
            ->limit(3)
            ->get();

        // Mengambil data model seri terbanyak
        $topmodelseries =
            ServiceTransaction::where('status_servis', 'Sudah Diambil')
            ->whereDate('tgl_ambil', '>=', $start_date)
            ->whereDate('tgl_ambil', '<=', $end_date)
            ->select('model_series.name as model_name')
            ->join('model_series', 'service_transactions.model_series_id', '=', 'model_series.id')
            ->groupBy('model_name')
            ->orderBy(DB::raw('COUNT(*)'), 'desc')
            ->limit(3)
            ->get();

        // Mengambil data model seri terbanyak
        $topactions =
            ServiceTransaction::where('status_servis', 'Sudah Diambil')
            ->whereDate('tgl_ambil', '>=', $start_date)
            ->whereDate('tgl_ambil', '<=', $end_date)
            ->select('service_actions.nama_tindakan as action_name')
            ->join('service_actions', 'service_transactions.service_actions_id', '=', 'service_actions.id')
            ->groupBy('action_name')
            ->orderBy(DB::raw('COUNT(*)'), 'desc')
            ->limit(3)
            ->get();

        // Menghitung total modal
        $total_modal = ServiceTransaction::where('status_servis', 'Sudah Diambil')
            ->whereDate('tgl_ambil', '>=', $start_date)
            ->whereDate('tgl_ambil', '<=', $end_date)
            ->sum('modal_sparepart');

        // Menghitung total biaya
        $total_biaya = ServiceTransaction::where('status_servis', 'Sudah Diambil')
            ->whereDate('tgl_ambil', '>=', $start_date)
            ->whereDate('tgl_ambil', '<=', $end_date)
            ->sum('biaya');

        // Menghitung total diskon
        $total_diskon = ServiceTransaction::where('is_approve', 'Setuju')
            ->where('kondisi_servis', "Sudah jadi")
            ->whereDate('tgl_ambil', '>=', $start_date)
            ->whereDate('tgl_ambil', '<=', $end_date)
            ->sum('diskon');

        // Menghitung total profit
        $total_profit = ServiceTransaction::where('status_servis', 'Sudah Diambil')
            ->whereDate('tgl_ambil', '>=', $start_date)
            ->whereDate('tgl_ambil', '<=', $end_date)
            ->sum('profit');

        $pdf = PDF::loadView('pages.admintoko.cetak-laporan-servis', [
            'users' => $users,
            'imagePath' => $imagePath,
            'services' => $services,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'total_modal' => $total_modal,
            'total_biaya' => $total_biaya,
            'total_diskon' => $total_diskon,
            'total_profit' => $total_profit,
            'topbrands' => $topbrands,
            'topmodelseries' => $topmodelseries,
            'topactions' => $topactions,
            'total_servis' => $total_servis,
            'total_tunai' => $total_tunai,
            'total_transfer' => $total_transfer,
            'total_kredit' => $total_kredit
        ]);

        $filename = 'Laporan Transaksi Servis' . ' ' . $start_date . ' ' . 'sd' . ' ' . $end_date . '.pdf';

        return $pdf->stream($filename);
    }
}
