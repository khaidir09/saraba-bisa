<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GaransiController;
use App\Http\Controllers\DataFeedController;
use App\Http\Controllers\HakAksesController;
use App\Http\Controllers\TrackingController;
// Kepala Toko
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KepalaToko\ApproveHandphoneController as KepalaTokoApproveHandphoneController;
use App\Http\Controllers\KepalaToko\ApproveSparepartController as KepalaTokoApproveSparepartController;
use App\Http\Controllers\KepalaToko\LaporanAksesorisController as KepalaTokoLaporanAksesorisController;
use App\Http\Controllers\KepalaToko\LaporanHandphoneController as KepalaTokoLaporanHandphoneController;
use App\Http\Controllers\KepalaToko\LaporanSparepartController as KepalaTokoLaporanSparepartController;
use App\Http\Controllers\KepalaToko\UbahBisaDiambilController as KepalaTokoUbahBisaDiambilController;
use App\Http\Controllers\KepalaToko\UbahSudahDiambilController as KepalaTokoUbahSudahDiambilController;
use App\Http\Controllers\KepalaToko\BisaDiambilController as KepalaTokoBisaDiambilController;
use App\Http\Controllers\KepalaToko\MasterMerekController as KepalaTokoMasterMerekController;
use App\Http\Controllers\KepalaToko\PhoneController as KepalaTokoPhoneController;
use App\Http\Controllers\KepalaToko\ApproveController as KepalaTokoApproveController;
use App\Http\Controllers\KepalaToko\AnggaranController as KepalaTokoAnggaranController;
use App\Http\Controllers\KepalaToko\AksesorisController as KepalaTokoAksesorisController;
use App\Http\Controllers\KepalaToko\DashboardController as KepalaTokoDashboardController;
use App\Http\Controllers\KepalaToko\PelangganController as KepalaTokoPelangganController;
use App\Http\Controllers\KepalaToko\SparepartController as KepalaTokoSparepartController;
use App\Http\Controllers\KepalaToko\MasterJenisBarangController as KepalaTokoMasterJenisBarangController;
use App\Http\Controllers\KepalaToko\TransaksiAksesorisController as KepalaTokoTransaksiAksesorisController;
use App\Http\Controllers\KepalaToko\TransaksiHandphoneController as KepalaTokoTransaksiHandphoneController;
use App\Http\Controllers\KepalaToko\TransaksiSparepartController as KepalaTokoTransaksiSparepartController;

use App\Http\Controllers\KepalaToko\PhoneTerjualController as KepalaTokoPhoneTerjualController;
use App\Http\Controllers\KepalaToko\SudahDiambilController as KepalaTokoSudahDiambilController;
use App\Http\Controllers\KepalaToko\InformasiTokoController as KepalaTokoInformasiTokoController;
use App\Http\Controllers\KepalaToko\LaporanServisController as KepalaTokoLaporanServisController;
use App\Http\Controllers\KepalaToko\TindakanServisController as KepalaTokoTindakanServisController;
use App\Http\Controllers\KepalaToko\MasterKapasitasController as KepalaTokoMasterKapasitasController;
use App\Http\Controllers\KepalaToko\MasterModelSeriController as KepalaTokoMasterModelSeriController;
use App\Http\Controllers\KepalaToko\TransaksiServisController as KepalaTokoTransaksiServisController;
use App\Http\Controllers\KepalaToko\ApproveAksesorisController as KepalaTokoApproveAksesorisController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', 'login');
Route::get('/hak-akses', [HakAksesController::class, 'index'])->name('hak-akses');
Route::get('/tracking', [TrackingController::class, 'index'])->name('tracking');
Route::get('/tracking-data', [TrackingController::class, 'data'])->name('tracking-data');
Route::get('/garansi', [GaransiController::class, 'index'])->name('garansi');
Route::get('/garansi-data', [GaransiController::class, 'data'])->name('garansi-data');

Route::middleware('ensureUserRole:KepalaToko')->group(function () {
    Route::get('/dashboard', [KepalaTokoDashboardController::class, 'index'])->name('dashboard');
    Route::resource('servis/tindakan-servis', KepalaTokoTindakanServisController::class);
    Route::resource('pelanggan', KepalaTokoPelangganController::class);
    Route::resource('servis/transaksi-servis', KepalaTokoTransaksiServisController::class);
    Route::resource('servis/transaksi-servis-approve', KepalaTokoApproveController::class);
    Route::resource('servis/transaksi-servis-bisa-diambil', KepalaTokoBisaDiambilController::class);
    Route::resource('servis/transaksi-servis-sudah-diambil', KepalaTokoSudahDiambilController::class);

    Route::resource('master/master-jenis-barang', KepalaTokoMasterJenisBarangController::class);
    Route::resource('master/master-merek', KepalaTokoMasterMerekController::class);
    Route::resource('master/master-kapasitas', KepalaTokoMasterKapasitasController::class);
    Route::resource('master/master-model-seri', KepalaTokoMasterModelSeriController::class);
    Route::resource('sparepart/data-sparepart', KepalaTokoSparepartController::class);
    Route::resource('sparepart/transaksi-sparepart', KepalaTokoTransaksiSparepartController::class);
    Route::resource('sparepart/transaksi-sparepart-approve', KepalaTokoApproveSparepartController::class);
    Route::resource('aksesoris/data-aksesoris', KepalaTokoAksesorisController::class);
    Route::resource('aksesoris/transaksi-aksesoris', KepalaTokoTransaksiAksesorisController::class);
    Route::resource('aksesoris/transaksi-aksesoris-approve', KepalaTokoApproveAksesorisController::class);
    Route::resource('phone/data-handphone', KepalaTokoPhoneController::class);
    Route::resource('phone/phone-terjual', KepalaTokoPhoneTerjualController::class);
    Route::resource('phone/transaksi-handphone-approve', KepalaTokoApproveHandphoneController::class);
    Route::resource('phone/transaksi-handphone', KepalaTokoTransaksiHandphoneController::class);
    Route::resource('anggaran', KepalaTokoAnggaranController::class);


    Route::get('laporan/laporan-servis', [KepalaTokoLaporanServisController::class, 'index'])->name('laporan-servis');
    Route::get('laporan/laporan-handphone', [KepalaTokoLaporanHandphoneController::class, 'index'])->name('laporan-handphone');
    Route::get('laporan/laporan-sparepart', [KepalaTokoLaporanSparepartController::class, 'index'])->name('laporan-sparepart');
    Route::get('laporan/laporan-aksesoris', [KepalaTokoLaporanAksesorisController::class, 'index'])->name('laporan-aksesoris');

    Route::get('informasi-toko', [KepalaTokoInformasiTokoController::class, 'index'])->name('informasi-toko');
    Route::post('informasi-toko', [KepalaTokoInformasiTokoController::class, 'update'])->name('informasi-toko-update');

    Route::get('servis/ubah-bisa-diambil/{id}', [KepalaTokoUbahBisaDiambilController::class, 'edit'])->name('ubah-bisa-diambil-edit');
    Route::post('servis/ubah-bisa-diambil{id}', [KepalaTokoUbahBisaDiambilController::class, 'update'])->name('ubah-bisa-diambil-update');
    Route::get('servis/ubah-sudah-diambil/{id}', [KepalaTokoUbahSudahDiambilController::class, 'edit'])->name('ubah-sudah-diambil-edit');
    Route::post('servis/ubah-sudah-diambil{id}', [KepalaTokoUbahSudahDiambilController::class, 'update'])->name('ubah-sudah-diambil-update');

    Route::get('nota-terima-termal/{id}', [KepalaTokoTransaksiServisController::class, 'cetaktermal'])->name('kepalatoko-cetak-termal');
    Route::get('kepalatoko-nota-pengambilan-termal/{id}', [KepalaTokoSudahDiambilController::class, 'pengambilantermal'])->name('kepalatoko-nota-pengambilan-termal');

    Route::post('/impor-pelanggan', [KepalaTokoPelangganController::class, 'import'])->name('impor-pelanggan');
    Route::get('export-pelanggan', [KepalaTokoPelangganController::class, 'export'])->name('pelanggan-export');
    Route::post('/impor-tindakan-servis', [KepalaTokoTindakanServisController::class, 'import'])->name('impor-tindakan-servis');
    Route::get('export-tindakan', [KepalaTokoTindakanServisController::class, 'export'])->name('tindakan-servis-export');
    Route::post('/impor-sparepart', [KepalaTokoSparepartController::class, 'import'])->name('impor-sparepart');
    Route::get('export-sparepart', [KepalaTokoSparepartController::class, 'export'])->name('sparepart-export');
    Route::post('/impor-aksesori', [KepalaTokoAksesorisController::class, 'import'])->name('impor-aksesori');
    Route::get('export-aksesori', [KepalaTokoAksesorisController::class, 'export'])->name('aksesori-export');
    Route::post('/impor-brand', [KepalaTokoMasterMerekController::class, 'import'])->name('impor-merek');
    Route::get('export-merek', [KepalaTokoMasterMerekController::class, 'export'])->name('merek-export');
    Route::post('/impor-model', [KepalaTokoMasterModelSeriController::class, 'import'])->name('impor-model');
    Route::get('export-modelseri', [KepalaTokoMasterModelSeriController::class, 'export'])->name('modelseri-export');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    // Route for the getting the data feed
    Route::get('/json-data-feed', [DataFeedController::class, 'getDataFeed'])->name('json_data_feed');
});
