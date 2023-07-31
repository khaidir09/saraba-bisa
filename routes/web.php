<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GaransiController;
use App\Http\Controllers\HakAksesController;
use App\Http\Controllers\TrackingController;
// Kepala Toko
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KepalaToko\DataServisController;
use App\Http\Controllers\KepalaToko\DataPenjualanController;
use App\Http\Controllers\KepalaToko\AkunController as KepalaTokoAkunController;
use App\Http\Controllers\KepalaToko\GajiController as KepalaTokoGajiController;
use App\Http\Controllers\Sales\DashboardController as SalesDashboardController;
use App\Http\Controllers\Sales\PelangganController as SalesPelangganController;
use App\Http\Controllers\Teknisi\AssemblyController as TeknisiAssemblyController;
use App\Http\Controllers\AdminToko\InsidenController as AdminTokoInsidenController;
use App\Http\Controllers\Teknisi\DashboardController as TeknisiDashboardController;
use App\Http\Controllers\Teknisi\PelangganController as TeknisiPelangganController;
use App\Http\Controllers\AdminToko\AssemblyController as AdminTokoAssemblyController;
use App\Http\Controllers\KepalaToko\ApproveController as KepalaTokoApproveController;
use App\Http\Controllers\KepalaToko\InsidenController as KepalaTokoInsidenController;
use App\Http\Controllers\AdminToko\DashboardController as AdminTokoDashboardController;
use App\Http\Controllers\AdminToko\PelangganController as AdminTokoPelangganController;
use App\Http\Controllers\KepalaToko\AnggaranController as KepalaTokoAnggaranController;
use App\Http\Controllers\KepalaToko\AssemblyController as KepalaTokoAssemblyController;
use App\Http\Controllers\KepalaToko\KaryawanController as KepalaTokoKaryawanController;
use App\Http\Controllers\Teknisi\BisaDiambilController as TeknisiBisaDiambilController;
use App\Http\Controllers\KepalaToko\AksesorisController as KepalaTokoAksesorisController;
use App\Http\Controllers\KepalaToko\DashboardController as KepalaTokoDashboardController;
use App\Http\Controllers\KepalaToko\PelangganController as KepalaTokoPelangganController;
use App\Http\Controllers\KepalaToko\SparepartController as KepalaTokoSparepartController;
use App\Http\Controllers\Teknisi\SudahDiambilController as TeknisiSudahDiambilController;
use App\Http\Controllers\AdminToko\BisaDiambilController as AdminTokoBisaDiambilController;
use App\Http\Controllers\AdminToko\MasterMerekController as AdminTokoMasterMerekController;
use App\Http\Controllers\AdminToko\SudahDiambilController as AdminTokoSudahDiambilController;
use App\Http\Controllers\KepalaToko\KasbonController as KepalaTokoKasbonController;
use App\Http\Controllers\KepalaToko\UbahStatusProsesServisController as KepalaTokoUbahStatusProsesServisController;
use App\Http\Controllers\KepalaToko\ExpenseController as KepalaTokoExpenseController;
use App\Http\Controllers\KepalaToko\ApprovePengeluaranController as KepalaTokoApprovePengeluaranController;

use App\Http\Controllers\KepalaToko\KategoriController as KepalaTokoKategoriController;
use App\Http\Controllers\KepalaToko\ProdukController as KepalaTokoProdukController;
use App\Http\Controllers\KepalaToko\ProdukTersediaController as KepalaTokoProdukTersediaController;
use App\Http\Controllers\KepalaToko\ProdukHabisController as KepalaTokoProdukHabisController;
use App\Http\Controllers\KepalaToko\ProdukUpdateController as KepalaTokoProdukUpdateController;
use App\Http\Controllers\KepalaToko\PosController as KepalaTokoPosController;
use App\Http\Controllers\KepalaToko\TransaksiProdukController as KepalaTokoTransaksiProdukController;
use App\Http\Controllers\KepalaToko\TransaksiProdukPaidController as KepalaTokoTransaksiProdukPaidController;
use App\Http\Controllers\KepalaToko\TransaksiProdukDueController as KepalaTokoTransaksiProdukDueController;
use App\Http\Controllers\KepalaToko\LaporanPenjualanController as KepalaTokoLaporanPenjualanController;
use App\Http\Controllers\KepalaToko\TermController as KepalaTokoTermController;
// Admin Toko
use App\Http\Controllers\KepalaToko\BisaDiambilController as KepalaTokoBisaDiambilController;
use App\Http\Controllers\KepalaToko\MasterMerekController as KepalaTokoMasterMerekController;
use App\Http\Controllers\Teknisi\LaporanTeknisiController as TeknisiLaporanTeknisiController;
use App\Http\Controllers\Teknisi\TindakanServisController as TeknisiTindakanServisController;
use App\Http\Controllers\KepalaToko\LaporanAdminController as KepalaTokoLaporanAdminController;
use App\Http\Controllers\KepalaToko\LaporanSalesController as KepalaTokoLaporanSalesController;
use App\Http\Controllers\KepalaToko\SudahDiambilController as KepalaTokoSudahDiambilController;
use App\Http\Controllers\Teknisi\LaporanAssemblyController as TeknisiLaporanAssemblyController;
use App\Http\Controllers\Teknisi\TransaksiServisController as TeknisiTransaksiServisController;
use App\Http\Controllers\Teknisi\UbahBisaDiambilController as TeknisiUbahBisaDiambilController;
use App\Http\Controllers\AdminToko\TindakanServisController as AdminTokoTindakanServisController;
use App\Http\Controllers\KepalaToko\InformasiTokoController as KepalaTokoInformasiTokoController;
use App\Http\Controllers\KepalaToko\LaporanServisController as KepalaTokoLaporanServisController;
use App\Http\Controllers\Teknisi\UbahSudahDiambilController as TeknisiUbahSudahDiambilController;
use App\Http\Controllers\AdminToko\MasterKapasitasController as AdminTokoMasterKapasitasController;
use App\Http\Controllers\AdminToko\MasterModelSeriController as AdminTokoMasterModelSeriController;
use App\Http\Controllers\AdminToko\UbahStatusProsesServisController as AdminTokoUbahStatusProsesServisController;
use App\Http\Controllers\AdminToko\ExpenseController as AdminTokoExpenseController;
use App\Http\Controllers\AdminToko\KategoriController as AdminTokoKategoriController;
use App\Http\Controllers\AdminToko\ProdukController as AdminTokoProdukController;
use App\Http\Controllers\AdminToko\ProdukTersediaController as AdminTokoProdukTersediaController;
use App\Http\Controllers\AdminToko\ProdukHabisController as AdminTokoProdukHabisController;
use App\Http\Controllers\AdminToko\ProdukUpdateController as AdminTokoProdukUpdateController;
use App\Http\Controllers\AdminToko\PosController as AdminTokoPosController;
use App\Http\Controllers\AdminToko\TransaksiProdukController as AdminTokoTransaksiProdukController;
use App\Http\Controllers\AdminToko\TransaksiProdukPaidController as AdminTokoTransaksiProdukPaidController;
use App\Http\Controllers\AdminToko\TransaksiProdukDueController as AdminTokoTransaksiProdukDueController;
use App\Http\Controllers\AdminToko\LaporanPenjualanController as AdminTokoLaporanPenjualanController;
// Teknisi
use App\Http\Controllers\AdminToko\TransaksiServisController as AdminTokoTransaksiServisController;
use App\Http\Controllers\AdminToko\UbahBisaDiambilController as AdminTokoUbahBisaDiambilController;
use App\Http\Controllers\KepalaToko\LaporanTeknisiController as KepalaTokoLaporanTeknisiController;
use App\Http\Controllers\KepalaToko\TindakanServisController as KepalaTokoTindakanServisController;
use App\Http\Controllers\AdminToko\UbahSudahDiambilController as AdminTokoUbahSudahDiambilController;
use App\Http\Controllers\KepalaToko\LaporanAssemblyController as KepalaTokoLaporanAssemblyController;
use App\Http\Controllers\KepalaToko\MasterKapasitasController as KepalaTokoMasterKapasitasController;
use App\Http\Controllers\KepalaToko\MasterModelSeriController as KepalaTokoMasterModelSeriController;
use App\Http\Controllers\KepalaToko\TransaksiServisController as KepalaTokoTransaksiServisController;
use App\Http\Controllers\AdminToko\MasterJenisBarangController as AdminTokoMasterJenisBarangController;
use App\Http\Controllers\Teknisi\UbahStatusProsesServisController as TeknisiUbahStatusProsesServisController;
use App\Http\Controllers\Teknisi\ExpenseController as TeknisiExpenseController;
use App\Http\Controllers\Teknisi\KasbonController as TeknisiKasbonController;
// Sales
use App\Http\Controllers\KepalaToko\UbahBisaDiambilController as KepalaTokoUbahBisaDiambilController;
use App\Http\Controllers\KepalaToko\UbahSudahDiambilController as KepalaTokoUbahSudahDiambilController;
use App\Http\Controllers\KepalaToko\MasterJenisBarangController as KepalaTokoMasterJenisBarangController;
use App\Http\Controllers\Sales\ExpenseController as SalesExpenseController;
use App\Http\Controllers\Sales\KategoriController as SalesKategoriController;
use App\Http\Controllers\Sales\ProdukController as SalesProdukController;
use App\Http\Controllers\Sales\PosController as SalesPosController;
use App\Http\Controllers\Sales\TransaksiProdukController as SalesTransaksiProdukController;
use App\Http\Controllers\Sales\TransaksiProdukPaidController as SalesTransaksiProdukPaidController;
use App\Http\Controllers\Sales\TransaksiProdukDueController as SalesTransaksiProdukDueController;
use App\Http\Controllers\Sales\LaporanPenjualanController as SalesLaporanPenjualanController;
use App\Http\Controllers\Sales\KasbonController as SalesKasbonController;

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
Route::get('/json-data-servis', [DataServisController::class, 'getDataServis'])->name('json_data_servis');
Route::get('/json-data-penjualan', [DataPenjualanController::class, 'getDataPenjualan'])->name('json_data_penjualan');

Route::middleware('ensureUserRole:KepalaToko')->group(function () {
    Route::get('/dashboard', [KepalaTokoDashboardController::class, 'index'])->name('kepalatoko-dashboard');
    Route::get('/akun', [KepalaTokoAkunController::class, 'index'])->name('akun');
    Route::post('/akun', [KepalaTokoAkunController::class, 'store'])->name('akun-store');
    Route::get('/akun/{id}', [KepalaTokoAkunController::class, 'edit'])->name('akun-edit');
    Route::post('/akun{id}', [KepalaTokoAkunController::class, 'update'])->name('akun-update');
    Route::delete('/akun/{id}', [KepalaTokoAkunController::class, 'destroy'])->name('akun-destroy');
    Route::resource('servis/tindakan-servis', KepalaTokoTindakanServisController::class);
    Route::resource('pelanggan', KepalaTokoPelangganController::class);
    Route::resource('servis/transaksi-servis', KepalaTokoTransaksiServisController::class);
    Route::resource('servis/transaksi-servis-approve', KepalaTokoApproveController::class);
    Route::resource('servis/transaksi-servis-bisa-diambil', KepalaTokoBisaDiambilController::class);
    Route::resource('servis/transaksi-servis-sudah-diambil', KepalaTokoSudahDiambilController::class);
    Route::resource('servis/assembly', KepalaTokoAssemblyController::class);
    Route::resource('master/master-jenis-barang', KepalaTokoMasterJenisBarangController::class);
    Route::resource('master/master-merek', KepalaTokoMasterMerekController::class);
    Route::resource('master/master-kapasitas', KepalaTokoMasterKapasitasController::class);
    Route::resource('master/master-model-seri', KepalaTokoMasterModelSeriController::class);
    Route::resource('anggaran', KepalaTokoAnggaranController::class);
    Route::resource('insiden', KepalaTokoInsidenController::class);
    Route::resource('kasbon', KepalaTokoKasbonController::class);
    Route::resource('gaji/karyawan', KepalaTokoKaryawanController::class);
    Route::resource('gaji/bonus', KepalaTokoGajiController::class);
    Route::resource('kasbon', KepalaTokoKasbonController::class);
    Route::resource('pengeluaran', KepalaTokoExpenseController::class);
    Route::resource('approve-pengeluaran', KepalaTokoApprovePengeluaranController::class);

    Route::get('laporan/laporan-servis', [KepalaTokoLaporanServisController::class, 'index'])->name('laporan-servis');
    Route::get('laporan/laporan-teknisi', [KepalaTokoLaporanTeknisiController::class, 'index'])->name('laporan-teknisi');
    Route::get('laporan/laporan-assembly', [KepalaTokoLaporanAssemblyController::class, 'index'])->name('laporan-assembly');
    Route::get('laporan/laporan-sales', [KepalaTokoLaporanSalesController::class, 'index'])->name('laporan-sales');
    Route::get('laporan/laporan-admin', [KepalaTokoLaporanAdminController::class, 'index'])->name('laporan-admin');

    Route::get('pengaturan/profil', [KepalaTokoInformasiTokoController::class, 'index'])->name('informasi-toko');
    Route::post('pengaturan/profil', [KepalaTokoInformasiTokoController::class, 'update'])->name('informasi-toko-update');
    Route::get('pengaturan/syarat-ketentuan', [KepalaTokoTermController::class, 'index'])->name('syarat-ketentuan');
    Route::post('pengaturan/syarat-ketentuan-terima', [KepalaTokoTermController::class, 'updateterima'])->name('ketentuan-terima-update');
    Route::post('pengaturan/syarat-ketentuan-pengambilan', [KepalaTokoTermController::class, 'updatepengambilan'])->name('ketentuan-pengambilan-update');
    Route::post('pengaturan/syarat-ketentuan-penjualan', [KepalaTokoTermController::class, 'updatepenjualan'])->name('ketentuan-penjualan-update');

    Route::get('servis/ubah-status-proses/{id}', [KepalaTokoUbahStatusProsesServisController::class, 'edit'])->name('ubah-status-proses-edit');
    Route::post('servis/ubah-status-proses{id}', [KepalaTokoUbahStatusProsesServisController::class, 'update'])->name('ubah-status-proses-update');
    Route::get('servis/ubah-bisa-diambil/{id}', [KepalaTokoUbahBisaDiambilController::class, 'edit'])->name('ubah-bisa-diambil-edit');
    Route::post('servis/ubah-bisa-diambil{id}', [KepalaTokoUbahBisaDiambilController::class, 'update'])->name('ubah-bisa-diambil-update');
    Route::get('servis/ubah-sudah-diambil/{id}', [KepalaTokoUbahSudahDiambilController::class, 'edit'])->name('ubah-sudah-diambil-edit');
    Route::post('servis/ubah-sudah-diambil{id}', [KepalaTokoUbahSudahDiambilController::class, 'update'])->name('ubah-sudah-diambil-update');

    Route::get('nota-terima-termal/{id}', [KepalaTokoTransaksiServisController::class, 'cetaktermal'])->name('kepalatoko-cetak-termal');
    Route::get('kepalatoko-nota-pengambilan-termal/{id}', [KepalaTokoSudahDiambilController::class, 'pengambilantermal'])->name('kepalatoko-nota-pengambilan-termal');
    Route::get('nota-terima-inkjet/{id}', [KepalaTokoTransaksiServisController::class, 'cetakinkjet'])->name('kepalatoko-cetak-inkjet');
    Route::get('nota-pengambilan-inkjet/{id}', [KepalaTokoSudahDiambilController::class, 'cetakinkjet'])->name('kepalatoko-pengambilan-cetak-inkjet');

    Route::get('slip-gaji/{id}', [KepalaTokoKaryawanController::class, 'cetak'])->name('cetak-slip-gaji');

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

    Route::resource('produk/kategori', KepalaTokoKategoriController::class);
    Route::resource('produk/item', KepalaTokoProdukController::class);
    Route::resource('produk/item-tersedia', KepalaTokoProdukTersediaController::class);
    Route::resource('produk/item-habis', KepalaTokoProdukHabisController::class);
    Route::resource('produk/produk-update', KepalaTokoProdukUpdateController::class);
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
});

Route::middleware('ensureAdminRole:AdminToko')->group(function () {
    Route::get('/admin-dashboard', [AdminTokoDashboardController::class, 'index'])->name('admintoko-dashboard');
    Route::resource('servis/admin-tindakan-servis', AdminTokoTindakanServisController::class);
    Route::resource('admin-pelanggan', AdminTokoPelangganController::class);
    Route::resource('servis/admin-transaksi-servis', AdminTokoTransaksiServisController::class);
    Route::resource('servis/admin-servis-bisa-diambil', AdminTokoBisaDiambilController::class);
    Route::resource('servis/admin-servis-sudah-diambil', AdminTokoSudahDiambilController::class);
    Route::resource('servis/admin-assembly', AdminTokoAssemblyController::class);
    Route::resource('master/admin-master-jenis-barang', AdminTokoMasterJenisBarangController::class);
    Route::resource('master/admin-master-merek', AdminTokoMasterMerekController::class);
    Route::resource('master/admin-master-kapasitas', AdminTokoMasterKapasitasController::class);
    Route::resource('master/admin-master-model-seri', AdminTokoMasterModelSeriController::class);
    Route::resource('admin-insiden', AdminTokoInsidenController::class);
    Route::resource('admin-pengeluaran', AdminTokoExpenseController::class);

    Route::get('tandaterima-termal/{id}', [AdminTokoTransaksiServisController::class, 'cetaktermal'])->name('admin-cetak-termal');
    Route::get('nota-pengambilan-termal/{id}', [AdminTokoSudahDiambilController::class, 'cetaktermal'])->name('admin-termal-pengambilan');
    Route::get('tandaterima-inkjet/{id}', [AdminTokoTransaksiServisController::class, 'cetakinkjet'])->name('admin-cetak-tanda-terima');
    Route::get('admin-nota-pengambilan-inkjet/{id}', [AdminTokoSudahDiambilController::class, 'cetakinkjet'])->name('admin-inkjet-pengambilan');

    Route::get('servis/admin-ubah-status-proses/{id}', [AdminTokoUbahStatusProsesServisController::class, 'edit'])->name('admin-ubah-status-proses-edit');
    Route::post('servis/admin-ubah-status-proses{id}', [AdminTokoUbahStatusProsesServisController::class, 'update'])->name('admin-ubah-status-proses-update');
    Route::get('servis/admin-ubah-bisa-diambil/{id}', [AdminTokoUbahBisaDiambilController::class, 'edit'])->name('admin-ubah-bisa-diambil-edit');
    Route::post('servis/admin-ubah-bisa-diambil{id}', [AdminTokoUbahBisaDiambilController::class, 'update'])->name('admin-ubah-bisa-diambil-update');
    Route::get('servis/admin-ubah-sudah-diambil/{id}', [AdminTokoUbahSudahDiambilController::class, 'edit'])->name('admin-ubah-sudah-diambil-edit');
    Route::post('servis/admin-ubah-sudah-diambil{id}', [AdminTokoUbahSudahDiambilController::class, 'update'])->name('admin-ubah-sudah-diambil-update');

    Route::post('/importindakanservis', [AdminTokoTindakanServisController::class, 'import'])->name('admin-impor-tindakan-servis');
    Route::post('/imporbrand', [AdminTokoMasterMerekController::class, 'import'])->name('admin-impor-merek');
    Route::post('/impormodel', [AdminTokoMasterModelSeriController::class, 'import'])->name('admin-impor-model');
    Route::post('/imporpelanggan', [AdminTokoPelangganController::class, 'import'])->name('admin-impor-pelanggan');

    Route::get('tindakan/export', [AdminTokoTindakanServisController::class, 'export'])->name('admin-tindakan-servis-export');
    Route::get('modelseri/export', [AdminTokoMasterModelSeriController::class, 'export'])->name('admin-modelseri-export');
    Route::get('merek/export', [AdminTokoMasterMerekController::class, 'export'])->name('admin-merek-export');
    Route::get('customer/export', [AdminTokoPelangganController::class, 'export'])->name('admin-pelanggan-export');

    Route::resource('produk/admin-kategori', AdminTokoKategoriController::class);
    Route::resource('produk/admin-item', AdminTokoProdukController::class);
    Route::resource('produk/admin-item-tersedia', AdminTokoProdukTersediaController::class);
    Route::resource('produk/admin-item-habis', AdminTokoProdukHabisController::class);
    Route::resource('produk/admin-produk-update', AdminTokoProdukUpdateController::class);
    Route::resource('produk/admin-pos', AdminTokoPosController::class);
    Route::resource('produk/admin-transaksi-produk', AdminTokoTransaksiProdukController::class);
    Route::resource('produk/admin-transaksi-produk-paid', AdminTokoTransaksiProdukPaidController::class);
    Route::resource('produk/admin-transaksi-produk-due', AdminTokoTransaksiProdukDueController::class);

    Route::get('/admin-order/due/{id}', [AdminTokoTransaksiProdukController::class, 'OrderDueAjax']);
    Route::post('produk/admin-update-due', [AdminTokoTransaksiProdukController::class, 'UpdateDue'])->name('admin-produk.updateDue');

    Route::get('produk/admin-pos', [AdminTokoPosController::class, 'index'])->name('admin-pos');
    Route::get('produk/admin-allitem', [AdminTokoPosController::class, 'AllItem']);
    Route::post('produk/admin-add-cart', [AdminTokoPosController::class, 'AddCart']);
    Route::post('produk/admin-cart-update/{rowId}', [AdminTokoPosController::class, 'CartUpdate']);
    Route::post('produk/admin-apply-discount', [AdminTokoPosController::class, 'ApplyDiscount'])->name('admin-produk.applyDiscount');
    Route::get('produk/admin-cart-remove/{rowId}', [AdminTokoPosController::class, 'CartRemove']);
    Route::post('produk/admin-create-invoice', [AdminTokoPosController::class, 'CreateInvoice']);
    Route::post('produk/admin-complete-order', [AdminTokoPosController::class, 'CompleteOrder']);

    Route::get('admin-transaksi-produk-inkjet/{orders_id}', [AdminTokoTransaksiProdukController::class, 'cetakinkjet'])->name('admin-lunas-cetak-inkjet');
    Route::get('admin-transaksi-produk-termal/{orders_id}', [AdminTokoTransaksiProdukController::class, 'cetaktermal'])->name('admin-cetak-termal-produk');

    Route::get('laporan/admin-laporan-penjualan', [AdminTokoLaporanPenjualanController::class, 'index'])->name('admin-laporan-penjualan');

    Route::post('/admin-import-produk', [AdminTokoProdukController::class, 'import'])->name('admin-import-produk');
    Route::get('admin-export-produk', [AdminTokoProdukController::class, 'export'])->name('admin-produk-export');
});

Route::middleware('ensureTeknisiRole:Teknisi')->group(function () {
    Route::get('/teknisi-dashboard', [TeknisiDashboardController::class, 'index'])->name('teknisi-dashboard');
    Route::resource('teknisi-pelanggan', TeknisiPelangganController::class);
    Route::resource('teknisi-tindakan-servis', TeknisiTindakanServisController::class);
    Route::resource('teknisi-transaksi-servis', TeknisiTransaksiServisController::class);
    Route::resource('teknisi-servis-bisa-diambil', TeknisiBisaDiambilController::class);
    Route::resource('teknisi-servis-sudah-diambil', TeknisiSudahDiambilController::class);
    Route::resource('teknisi-assembly', TeknisiAssemblyController::class);
    Route::resource('teknisi-pengeluaran', TeknisiExpenseController::class);
    Route::resource('teknisi-kasbon', TeknisiKasbonController::class);

    Route::get('teknisi/tandaterima-inkjet/{id}', [TeknisiTransaksiServisController::class, 'cetakinkjet'])->name('teknisi-cetak-tanda-terima');
    Route::get('teknisi/tandaterima-termal/{id}', [TeknisiTransaksiServisController::class, 'cetaktermal'])->name('teknisi-cetak-termal');
    Route::get('teknisi-nota-pengambilan-termal/{id}', [TeknisiSudahDiambilController::class, 'cetaktermal'])->name('teknisi-termal-pengambilan');
    Route::get('teknisi-nota-pengambilan-inkjet/{id}', [TeknisiSudahDiambilController::class, 'cetakinkjet'])->name('teknisi-inkjet-pengambilan');

    Route::get('/teknisi-laporan', [TeknisiLaporanTeknisiController::class, 'index'])->name('teknisi-laporan');
    Route::get('/teknisi-laporan-assembly', [TeknisiLaporanAssemblyController::class, 'index'])->name('teknisi-laporan-assembly');

    Route::get('teknisi/ubah-status-proses/{id}', [TeknisiUbahStatusProsesServisController::class, 'edit'])->name('teknisi-ubah-status-proses-edit');
    Route::post('teknisi/ubah-status-proses{id}', [TeknisiUbahStatusProsesServisController::class, 'update'])->name('teknisi-ubah-status-proses-update');
    Route::get('teknisi/servis-ubah-bisa-diambil/{id}', [TeknisiUbahBisaDiambilController::class, 'edit'])->name('teknisi-ubah-bisa-diambil-edit');
    Route::post('teknisi/servis-ubah-bisa-diambil{id}', [TeknisiUbahBisaDiambilController::class, 'update'])->name('teknisi-ubah-bisa-diambil-update');
    Route::get('teknisi/servis-ubah-sudah-diambil/{id}', [TeknisiUbahSudahDiambilController::class, 'edit'])->name('teknisi-ubah-sudah-diambil-edit');
    Route::post('teknisi/servis-ubah-sudah-diambil{id}', [TeknisiUbahSudahDiambilController::class, 'update'])->name('teknisi-ubah-sudah-diambil-update');
});

Route::middleware('ensureSalesRole:Sales')->group(
    function () {
        Route::get('/sales-dashboard', [SalesDashboardController::class, 'index'])->name('sales-dashboard');
        Route::resource('sales-pelanggan', SalesPelangganController::class);
        Route::resource('sales-pengeluaran', SalesExpenseController::class);
        Route::resource('sales-kasbon', SalesKasbonController::class);

        Route::resource('produk/sales-kategori', SalesKategoriController::class);
        Route::resource('produk/sales-item', SalesProdukController::class);
        Route::resource('produk/sales-pos', SalesPosController::class);
        Route::resource('produk/sales-transaksi-produk', SalesTransaksiProdukController::class);
        Route::resource('produk/sales-transaksi-produk-paid', SalesTransaksiProdukPaidController::class);
        Route::resource('produk/sales-transaksi-produk-due', SalesTransaksiProdukDueController::class);

        Route::get('/sales-order/due/{id}', [SalesTransaksiProdukController::class, 'OrderDueAjax']);
        Route::post('produk/sales-update-due', [SalesTransaksiProdukController::class, 'UpdateDue'])->name('sales-produk.updateDue');

        Route::get('produk/sales-pos', [SalesPosController::class, 'index'])->name('sales-pos');
        Route::get('produk/sales-allitem', [SalesPosController::class, 'AllItem']);
        Route::post('produk/sales-add-cart', [SalesPosController::class, 'AddCart']);
        Route::post('produk/sales-cart-update/{rowId}', [SalesPosController::class, 'CartUpdate']);
        Route::post('produk/sales-apply-discount', [SalesPosController::class, 'ApplyDiscount'])->name('sales-produk.applyDiscount');
        Route::get('produk/sales-cart-remove/{rowId}', [SalesPosController::class, 'CartRemove']);
        Route::post('produk/sales-create-invoice', [SalesPosController::class, 'CreateInvoice']);
        Route::post('produk/sales-complete-order', [SalesPosController::class, 'CompleteOrder']);

        Route::get('sales-transaksi-produk-inkjet/{orders_id}', [SalesTransaksiProdukController::class, 'cetakinkjet'])->name('sales-lunas-cetak-inkjet');
        Route::get('sales-transaksi-produk-termal/{orders_id}', [SalesTransaksiProdukController::class, 'cetaktermal'])->name('sales-cetak-termal-produk');

        Route::post('/sales-import-produk', [SalesProdukController::class, 'import'])->name('sales-import-produk');
        Route::get('sales-export-produk', [SalesProdukController::class, 'export'])->name('sales-produk-export');

        Route::get('sales-laporan-penjualan', [SalesLaporanPenjualanController::class, 'index'])->name('sales-laporan-penjualan');
    }
);

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/old-dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
