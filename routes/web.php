<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GaransiController;
use App\Http\Controllers\DataFeedController;
use App\Http\Controllers\HakAksesController;
use App\Http\Controllers\TrackingController;
// Kepala Toko
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KepalaToko\UbahBisaDiambilController as KepalaTokoUbahBisaDiambilController;
use App\Http\Controllers\KepalaToko\UbahSudahDiambilController as KepalaTokoUbahSudahDiambilController;
use App\Http\Controllers\KepalaToko\UbahStatusProsesServisController as KepalaTokoUbahStatusProsesServisController;
use App\Http\Controllers\KepalaToko\BisaDiambilController as KepalaTokoBisaDiambilController;
use App\Http\Controllers\KepalaToko\MasterMerekController as KepalaTokoMasterMerekController;
use App\Http\Controllers\KepalaToko\ApproveController as KepalaTokoApproveController;
use App\Http\Controllers\KepalaToko\AnggaranController as KepalaTokoAnggaranController;
use App\Http\Controllers\KepalaToko\DashboardController as KepalaTokoDashboardController;
use App\Http\Controllers\KepalaToko\PelangganController as KepalaTokoPelangganController;
use App\Http\Controllers\KepalaToko\MasterJenisBarangController as KepalaTokoMasterJenisBarangController;

use App\Http\Controllers\KepalaToko\SudahDiambilController as KepalaTokoSudahDiambilController;
use App\Http\Controllers\KepalaToko\InformasiTokoController as KepalaTokoInformasiTokoController;
use App\Http\Controllers\KepalaToko\LaporanServisController as KepalaTokoLaporanServisController;
use App\Http\Controllers\KepalaToko\TindakanServisController as KepalaTokoTindakanServisController;
use App\Http\Controllers\KepalaToko\MasterKapasitasController as KepalaTokoMasterKapasitasController;
use App\Http\Controllers\KepalaToko\MasterModelSeriController as KepalaTokoMasterModelSeriController;
use App\Http\Controllers\KepalaToko\TransaksiServisController as KepalaTokoTransaksiServisController;

use App\Http\Controllers\KepalaToko\KategoriController as KepalaTokoKategoriController;
use App\Http\Controllers\KepalaToko\ProdukController as KepalaTokoProdukController;
use App\Http\Controllers\KepalaToko\PosController as KepalaTokoPosController;
use App\Http\Controllers\KepalaToko\TransaksiProdukController as KepalaTokoTransaksiProdukController;
use App\Http\Controllers\KepalaToko\LaporanPenjualanController as KepalaTokoLaporanPenjualanController;

use App\Http\Controllers\KepalaToko\ExpenseController as KepalaTokoExpenseController;
use App\Http\Controllers\KepalaToko\TermController as KepalaTokoTermController;

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
    Route::resource('anggaran', KepalaTokoAnggaranController::class);


    Route::get('laporan/laporan-servis', [KepalaTokoLaporanServisController::class, 'index'])->name('laporan-servis');

    Route::get('informasi-toko', [KepalaTokoInformasiTokoController::class, 'index'])->name('informasi-toko');
    Route::post('informasi-toko', [KepalaTokoInformasiTokoController::class, 'update'])->name('informasi-toko-update');

    Route::get('servis/ubah-status-proses/{id}', [KepalaTokoUbahStatusProsesServisController::class, 'edit'])->name('ubah-status-proses-edit');
    Route::post('servis/ubah-status-proses{id}', [KepalaTokoUbahStatusProsesServisController::class, 'update'])->name('ubah-status-proses-update');
    Route::get('servis/ubah-bisa-diambil/{id}', [KepalaTokoUbahBisaDiambilController::class, 'edit'])->name('ubah-bisa-diambil-edit');
    Route::post('servis/ubah-bisa-diambil{id}', [KepalaTokoUbahBisaDiambilController::class, 'update'])->name('ubah-bisa-diambil-update');
    Route::get('servis/ubah-sudah-diambil/{id}', [KepalaTokoUbahSudahDiambilController::class, 'edit'])->name('ubah-sudah-diambil-edit');
    Route::post('servis/ubah-sudah-diambil{id}', [KepalaTokoUbahSudahDiambilController::class, 'update'])->name('ubah-sudah-diambil-update');

    Route::get('nota-terima-termal/{id}', [KepalaTokoTransaksiServisController::class, 'cetaktermal'])->name('kepalatoko-cetak-termal');
    Route::get('kepalatoko-nota-pengambilan-termal/{id}', [KepalaTokoSudahDiambilController::class, 'pengambilantermal'])->name('kepalatoko-nota-pengambilan-termal');
    Route::get('nota-pengambilan-inkjet/{id}', [KepalaTokoSudahDiambilController::class, 'cetakinkjet'])->name('nota-pengambilan-inkjet');
    Route::get('nota-terima-inkjet/{id}', [KepalaTokoTransaksiServisController::class, 'cetakinkjet'])->name('nota-terima-inkjet');

    Route::post('/impor-pelanggan', [KepalaTokoPelangganController::class, 'import'])->name('impor-pelanggan');
    Route::get('export-pelanggan', [KepalaTokoPelangganController::class, 'export'])->name('pelanggan-export');
    Route::post('/impor-tindakan-servis', [KepalaTokoTindakanServisController::class, 'import'])->name('impor-tindakan-servis');
    Route::get('export-tindakan', [KepalaTokoTindakanServisController::class, 'export'])->name('tindakan-servis-export');
    Route::post('/impor-brand', [KepalaTokoMasterMerekController::class, 'import'])->name('impor-merek');
    Route::get('export-merek', [KepalaTokoMasterMerekController::class, 'export'])->name('merek-export');
    Route::post('/impor-model', [KepalaTokoMasterModelSeriController::class, 'import'])->name('impor-model');
    Route::get('export-modelseri', [KepalaTokoMasterModelSeriController::class, 'export'])->name('modelseri-export');

    Route::resource('pengeluaran', KepalaTokoExpenseController::class);

    Route::resource('produk/kategori', KepalaTokoKategoriController::class);
    Route::resource('produk/item', KepalaTokoProdukController::class);
    Route::resource('produk/pos', KepalaTokoPosController::class);
    Route::resource('produk/transaksi-produk', KepalaTokoTransaksiProdukController::class);
    Route::resource('produk/transaksi-produk-paid', KepalaTokoTransaksiProdukPaidController::class);
    Route::resource('produk/transaksi-produk-due', KepalaTokoTransaksiProdukDueController::class);

    Route::get('/order/due/{id}', [KepalaTokoTransaksiProdukController::class, 'OrderDueAjax']);
    Route::post('produk/update-due', [KepalaTokoTransaksiProdukController::class, 'UpdateDue'])->name('produk.updateDue');

    Route::get('produk/pos', [KepalaTokoPosController::class, 'index'])->name('pos');
    Route::get('produk/allitem', [KepalaTokoPosController::class, 'AllItem']);
    Route::post('produk/add-cart', [KepalaTokoPosController::class, 'AddCart']);
    Route::post('produk/cart-update/{rowId}', [KepalaTokoPosController::class, 'CartUpdate']);
    Route::post('produk/apply-discount', [KepalaTokoPosController::class, 'ApplyDiscount'])->name('produk.applyDiscount');
    Route::get('produk/cart-remove/{rowId}', [KepalaTokoPosController::class, 'CartRemove']);
    Route::post('produk/create-invoice', [KepalaTokoPosController::class, 'CreateInvoice']);
    Route::post('produk/complete-order', [KepalaTokoPosController::class, 'CompleteOrder']);

    Route::get('transaksi-produk-inkjet/{orders_id}', [KepalaTokoTransaksiProdukController::class, 'cetakinkjet'])->name('lunas-cetak-inkjet');
    Route::get('transaksi-produk-termal/{orders_id}', [KepalaTokoTransaksiProdukController::class, 'cetaktermal'])->name('cetak-termal');

    Route::get('laporan/laporan-penjualan', [KepalaTokoLaporanPenjualanController::class, 'index'])->name('laporan-penjualan');

    Route::post('/import-produk', [KepalaTokoProdukController::class, 'import'])->name('import-produk');
    Route::get('export-produk', [KepalaTokoProdukController::class, 'export'])->name('produk-export');

    Route::get('pengaturan/profil', [KepalaTokoInformasiTokoController::class, 'index'])->name('informasi-toko');
    Route::post('pengaturan/profil', [KepalaTokoInformasiTokoController::class, 'update'])->name('informasi-toko-update');
    Route::get('pengaturan/syarat-ketentuan', [KepalaTokoTermController::class, 'index'])->name('syarat-ketentuan');
    Route::post('pengaturan/syarat-ketentuan-terima', [KepalaTokoTermController::class, 'updateterima'])->name('ketentuan-terima-update');
    Route::post('pengaturan/syarat-ketentuan-pengambilan', [KepalaTokoTermController::class, 'updatepengambilan'])->name('ketentuan-pengambilan-update');
    Route::post('pengaturan/syarat-ketentuan-penjualan', [KepalaTokoTermController::class, 'updatepenjualan'])->name('ketentuan-penjualan-update');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    // Route for the getting the data feed
    Route::get('/json-data-feed', [DataFeedController::class, 'getDataFeed'])->name('json_data_feed');
});
