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
use App\Http\Controllers\KepalaToko\UbahStatusProsesServisController as KepalaTokoUbahStatusProsesServisController;
use App\Http\Controllers\KepalaToko\AkunController as KepalaTokoAkunController;
use App\Http\Controllers\KepalaToko\ExpenseController as KepalaTokoExpenseController;
use App\Http\Controllers\KepalaToko\ApprovePengeluaranController as KepalaTokoApprovePengeluaranController;
use App\Http\Controllers\KepalaToko\GajiController as KepalaTokoGajiController;
use App\Http\Controllers\KepalaToko\BisaDiambilController as KepalaTokoBisaDiambilController;
use App\Http\Controllers\KepalaToko\MasterMerekController as KepalaTokoMasterMerekController;
use App\Http\Controllers\KepalaToko\PhoneController as KepalaTokoPhoneController;
use App\Http\Controllers\KepalaToko\ApproveController as KepalaTokoApproveController;
use App\Http\Controllers\KepalaToko\InsidenController as KepalaTokoInsidenController;
use App\Http\Controllers\KepalaToko\AnggaranController as KepalaTokoAnggaranController;
use App\Http\Controllers\KepalaToko\KaryawanController as KepalaTokoKaryawanController;
use App\Http\Controllers\KepalaToko\AksesorisController as KepalaTokoAksesorisController;
use App\Http\Controllers\KepalaToko\DashboardController as KepalaTokoDashboardController;
use App\Http\Controllers\KepalaToko\PelangganController as KepalaTokoPelangganController;
use App\Http\Controllers\KepalaToko\SparepartController as KepalaTokoSparepartController;
use App\Http\Controllers\KepalaToko\KasbonController as KepalaTokoKasbonController;
use App\Http\Controllers\KepalaToko\MasterJenisBarangController as KepalaTokoMasterJenisBarangController;
use App\Http\Controllers\KepalaToko\TransaksiAksesorisController as KepalaTokoTransaksiAksesorisController;
use App\Http\Controllers\KepalaToko\TransaksiHandphoneController as KepalaTokoTransaksiHandphoneController;
use App\Http\Controllers\KepalaToko\TransaksiSparepartController as KepalaTokoTransaksiSparepartController;
// Admin Toko
use App\Http\Controllers\AdminToko\BisaDiambilController as AdminTokoBisaDiambilController;
use App\Http\Controllers\AdminToko\MasterMerekController as AdminTokoMasterMerekController;
use App\Http\Controllers\AdminToko\ExpenseController as AdminTokoExpenseController;
use App\Http\Controllers\AdminToko\PhoneTerjualController as AdminTokoPhoneTerjualController;
use App\Http\Controllers\AdminToko\SudahDiambilController as AdminTokoSudahDiambilController;
use App\Http\Controllers\AdminToko\PhoneController as AdminTokoPhoneController;
use App\Http\Controllers\AdminToko\KasbonController as AdminTokoKasbonController;
use App\Http\Controllers\AdminToko\InsidenController as AdminTokoInsidenController;
use App\Http\Controllers\AdminToko\AksesorisController as AdminTokoAksesorisController;
use App\Http\Controllers\AdminToko\DashboardController as AdminTokoDashboardController;
use App\Http\Controllers\AdminToko\PelangganController as AdminTokoPelangganController;
use App\Http\Controllers\AdminToko\SparepartController as AdminTokoSparepartController;
use App\Http\Controllers\AdminToko\UbahStatusProsesServisController as AdminTokoUbahStatusProsesServisController;

use App\Http\Controllers\Teknisi\LaporanTeknisiController as TeknisiLaporanTeknisiController;
use App\Http\Controllers\Teknisi\TindakanServisController as TeknisiTindakanServisController;
use App\Http\Controllers\KepalaToko\LaporanAdminController as KepalaTokoLaporanAdminController;
use App\Http\Controllers\KepalaToko\LaporanSalesController as KepalaTokoLaporanSalesController;
use App\Http\Controllers\KepalaToko\PhoneTerjualController as KepalaTokoPhoneTerjualController;
use App\Http\Controllers\KepalaToko\SudahDiambilController as KepalaTokoSudahDiambilController;
use App\Http\Controllers\Teknisi\TransaksiServisController as TeknisiTransaksiServisController;
use App\Http\Controllers\Teknisi\UbahBisaDiambilController as TeknisiUbahBisaDiambilController;
use App\Http\Controllers\AdminToko\TindakanServisController as AdminTokoTindakanServisController;
use App\Http\Controllers\KepalaToko\InformasiTokoController as KepalaTokoInformasiTokoController;
use App\Http\Controllers\KepalaToko\LaporanServisController as KepalaTokoLaporanServisController;
use App\Http\Controllers\Sales\TransaksiAksesorisController as SalesTransaksiAksesorisController;
use App\Http\Controllers\Sales\TransaksiHandphoneController as SalesTransaksiHandphoneController;
use App\Http\Controllers\Sales\TransaksiSparepartController as SalesTransaksiSparepartController;
use App\Http\Controllers\Teknisi\UbahSudahDiambilController as TeknisiUbahSudahDiambilController;
use App\Http\Controllers\AdminToko\MasterKapasitasController as AdminTokoMasterKapasitasController;
use App\Http\Controllers\AdminToko\MasterModelSeriController as AdminTokoMasterModelSeriController;
use App\Http\Controllers\AdminToko\TransaksiAksesorisController as AdminTokoTransaksiAksesorisController;
use App\Http\Controllers\AdminToko\TransaksiHandphoneController as AdminTokoTransaksiHandphoneController;
use App\Http\Controllers\AdminToko\TransaksiSparepartController as AdminTokoTransaksiSparepartController;
// Teknisi
use App\Http\Controllers\Teknisi\DashboardController as TeknisiDashboardController;
use App\Http\Controllers\Teknisi\SudahDiambilController as TeknisiSudahDiambilController;
use App\Http\Controllers\Teknisi\BisaDiambilController as TeknisiBisaDiambilController;
use App\Http\Controllers\Teknisi\PelangganController as TeknisiPelangganController;
use App\Http\Controllers\Teknisi\ExpenseController as TeknisiExpenseController;
use App\Http\Controllers\AdminToko\TransaksiServisController as AdminTokoTransaksiServisController;
use App\Http\Controllers\AdminToko\UbahBisaDiambilController as AdminTokoUbahBisaDiambilController;
use App\Http\Controllers\KepalaToko\LaporanTeknisiController as KepalaTokoLaporanTeknisiController;
use App\Http\Controllers\KepalaToko\TindakanServisController as KepalaTokoTindakanServisController;
use App\Http\Controllers\AdminToko\UbahSudahDiambilController as AdminTokoUbahSudahDiambilController;
use App\Http\Controllers\KepalaToko\MasterKapasitasController as KepalaTokoMasterKapasitasController;
use App\Http\Controllers\KepalaToko\MasterModelSeriController as KepalaTokoMasterModelSeriController;
use App\Http\Controllers\KepalaToko\TransaksiServisController as KepalaTokoTransaksiServisController;
use App\Http\Controllers\AdminToko\MasterJenisBarangController as AdminTokoMasterJenisBarangController;
use App\Http\Controllers\KepalaToko\ApproveAksesorisController as KepalaTokoApproveAksesorisController;
use App\Http\Controllers\Teknisi\MasterModelSeriController as TeknisiMasterModelSeriController;
use App\Http\Controllers\Teknisi\SparepartController as TeknisiSparepartController;
use App\Http\Controllers\Teknisi\UbahStatusProsesServisController as TeknisiUbahStatusProsesServisController;
// Sales
use App\Http\Controllers\Sales\LaporanAksesorisController as SalesLaporanAksesorisController;
use App\Http\Controllers\Sales\LaporanHandphoneController as SalesLaporanHandphoneController;
use App\Http\Controllers\Sales\LaporanSparepartController as SalesLaporanSparepartController;
use App\Http\Controllers\Sales\PhoneTerjualController as SalesPhoneTerjualController;
use App\Http\Controllers\Sales\PhoneController as SalesPhoneController;
use App\Http\Controllers\Sales\AksesorisController as SalesAksesorisController;
use App\Http\Controllers\Sales\DashboardController as SalesDashboardController;
use App\Http\Controllers\Sales\PelangganController as SalesPelangganController;
use App\Http\Controllers\Sales\SparepartController as SalesSparepartController;
use App\Http\Controllers\Sales\ExpenseController as SalesExpenseController;


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
    Route::resource('insiden', KepalaTokoInsidenController::class);
    Route::resource('kasbon', KepalaTokoKasbonController::class);
    Route::resource('gaji/karyawan', KepalaTokoKaryawanController::class);
    Route::resource('gaji/bonus', KepalaTokoGajiController::class);
    Route::resource('kasbon', KepalaTokoKasbonController::class);
    Route::resource('pengeluaran', KepalaTokoExpenseController::class);
    Route::resource('approve-pengeluaran', KepalaTokoApprovePengeluaranController::class);

    Route::get('laporan/laporan-servis', [KepalaTokoLaporanServisController::class, 'index'])->name('laporan-servis');
    Route::get('laporan/laporan-handphone', [KepalaTokoLaporanHandphoneController::class, 'index'])->name('laporan-handphone');
    Route::get('laporan/laporan-sparepart', [KepalaTokoLaporanSparepartController::class, 'index'])->name('laporan-sparepart');
    Route::get('laporan/laporan-aksesoris', [KepalaTokoLaporanAksesorisController::class, 'index'])->name('laporan-aksesoris');
    Route::get('laporan/laporan-teknisi', [KepalaTokoLaporanTeknisiController::class, 'index'])->name('laporan-teknisi');

    Route::get('laporan/laporan-sales', [KepalaTokoLaporanSalesController::class, 'index'])->name('laporan-sales');
    Route::get('laporan/laporan-admin', [KepalaTokoLaporanAdminController::class, 'index'])->name('laporan-admin');
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
});

Route::middleware('ensureAdminRole:AdminToko')->group(function () {
    Route::get('/admin-dashboard', [AdminTokoDashboardController::class, 'index'])->name('admintoko-dashboard');
    Route::resource('servis/admin-tindakan-servis', AdminTokoTindakanServisController::class);
    Route::resource('admin-pelanggan', AdminTokoPelangganController::class);
    Route::resource('servis/admin-transaksi-servis', AdminTokoTransaksiServisController::class);
    Route::resource('servis/admin-servis-bisa-diambil', AdminTokoBisaDiambilController::class);
    Route::resource('servis/admin-servis-sudah-diambil', AdminTokoSudahDiambilController::class);
    Route::resource('master/admin-master-jenis-barang', AdminTokoMasterJenisBarangController::class);
    Route::resource('master/admin-master-merek', AdminTokoMasterMerekController::class);
    Route::resource('master/admin-master-kapasitas', AdminTokoMasterKapasitasController::class);
    Route::resource('master/admin-master-model-seri', AdminTokoMasterModelSeriController::class);
    Route::resource('sparepart/admin-data-sparepart', AdminTokoSparepartController::class);
    Route::resource('sparepart/admin-transaksi-sparepart', AdminTokoTransaksiSparepartController::class);
    Route::resource('aksesoris/admin-data-aksesoris', AdminTokoAksesorisController::class);
    Route::resource('aksesoris/admin-transaksi-aksesoris', AdminTokoTransaksiAksesorisController::class);
    Route::resource('phone/admin-data-handphone', AdminTokoPhoneController::class);
    Route::resource('phone/admin-phone-terjual', AdminTokoPhoneTerjualController::class);
    Route::resource('phone/admin-transaksi-handphone', AdminTokoTransaksiHandphoneController::class);
    Route::resource('admin-insiden', AdminTokoInsidenController::class);
    Route::resource('admin-kasbon', AdminTokoKasbonController::class);
    Route::resource('admin-pengeluaran', AdminTokoExpenseController::class);

    Route::get('tandaterima/{id}', [AdminTokoTransaksiServisController::class, 'cetak'])->name('admin-cetak-tanda-terima');
    Route::get('tandaterima-termal/{id}', [AdminTokoTransaksiServisController::class, 'cetaktermal'])->name('admin-cetak-termal');
    Route::get('nota-sparepart-termal/{id}', [AdminTokoTransaksiSparepartController::class, 'cetaktermal'])->name('admin-nota-sparepart-termal');
    Route::get('nota-handphone-termal/{id}', [AdminTokoTransaksiHandphoneController::class, 'cetaktermal'])->name('admin-nota-handphone-termal');
    Route::get('nota-aksesori-termal/{id}', [AdminTokoTransaksiAksesorisController::class, 'cetaktermal'])->name('admin-nota-aksesori-termal');

    Route::get('nota-pengambilan-termal/{id}', [AdminTokoSudahDiambilController::class, 'cetaktermal'])->name('admin-termal-pengambilan');

    Route::get('servis/admin-ubah-status-proses/{id}', [AdminTokoUbahStatusProsesServisController::class, 'edit'])->name('admin-ubah-status-proses-edit');
    Route::post('servis/admin-ubah-status-proses{id}', [AdminTokoUbahStatusProsesServisController::class, 'update'])->name('admin-ubah-status-proses-update');
    Route::get('servis/admin-ubah-bisa-diambil/{id}', [AdminTokoUbahBisaDiambilController::class, 'edit'])->name('admin-ubah-bisa-diambil-edit');
    Route::post('servis/admin-ubah-bisa-diambil{id}', [AdminTokoUbahBisaDiambilController::class, 'update'])->name('admin-ubah-bisa-diambil-update');
    Route::get('servis/admin-ubah-sudah-diambil/{id}', [AdminTokoUbahSudahDiambilController::class, 'edit'])->name('admin-ubah-sudah-diambil-edit');
    Route::post('servis/admin-ubah-sudah-diambil{id}', [AdminTokoUbahSudahDiambilController::class, 'update'])->name('admin-ubah-sudah-diambil-update');

    Route::post('/importindakanservis', [AdminTokoTindakanServisController::class, 'import'])->name('admin-impor-tindakan-servis');
    Route::post('/imporsparepart', [AdminTokoSparepartController::class, 'import'])->name('admin-impor-sparepart');
    Route::post('/imporaksesori', [AdminTokoAksesorisController::class, 'import'])->name('admin-impor-aksesori');
    Route::post('/imporhandphone', [AdminTokoPhoneController::class, 'import'])->name('admin-impor-handphone');
    Route::post('/imporbrand', [AdminTokoMasterMerekController::class, 'import'])->name('admin-impor-merek');
    Route::post('/impormodel', [AdminTokoMasterModelSeriController::class, 'import'])->name('admin-impor-model');
    Route::post('/imporpelanggan', [AdminTokoPelangganController::class, 'import'])->name('admin-impor-pelanggan');

    Route::get('tindakan/export', [AdminTokoTindakanServisController::class, 'export'])->name('admin-tindakan-servis-export');
    Route::get('sparepart/export', [AdminTokoSparepartController::class, 'export'])->name('admin-sparepart-export');
    Route::get('aksesori/export', [AdminTokoAksesorisController::class, 'export'])->name('admin-aksesori-export');
    Route::get('modelseri/export', [AdminTokoMasterModelSeriController::class, 'export'])->name('admin-modelseri-export');
    Route::get('merek/export', [AdminTokoMasterMerekController::class, 'export'])->name('admin-merek-export');
    Route::get('customer/export', [AdminTokoPelangganController::class, 'export'])->name('admin-pelanggan-export');
});

Route::middleware('ensureTeknisiRole:Teknisi')->group(function () {
    Route::get('/teknisi-dashboard', [TeknisiDashboardController::class, 'index'])->name('teknisi-dashboard');
    Route::resource('teknisi-pengeluaran', TeknisiExpenseController::class);
    Route::resource('teknisi-pelanggan', TeknisiPelangganController::class);
    Route::resource('teknisi-tindakan-servis', TeknisiTindakanServisController::class);
    Route::resource('teknisi-transaksi-servis', TeknisiTransaksiServisController::class);
    Route::resource('teknisi-servis-bisa-diambil', TeknisiBisaDiambilController::class);
    Route::resource('teknisi-servis-sudah-diambil', TeknisiSudahDiambilController::class);
    Route::resource('master/teknisi-master-model-seri', TeknisiMasterModelSeriController::class);
    Route::resource('sparepart/teknisi-data-sparepart', TeknisiSparepartController::class);
    Route::get('teknisi/tandaterima/{id}', [TeknisiTransaksiServisController::class, 'cetak'])->name('teknisi-cetak-tanda-terima');
    Route::get('teknisi/tandaterima-termal/{id}', [TeknisiTransaksiServisController::class, 'cetaktermal'])->name('teknisi-cetak-termal');
    Route::get('/teknisi-laporan', [TeknisiLaporanTeknisiController::class, 'index'])->name('teknisi-laporan');

    Route::get('teknisi/ubah-status-proses/{id}', [TeknisiUbahStatusProsesServisController::class, 'edit'])->name('teknisi-ubah-status-proses-edit');
    Route::post('teknisi/ubah-status-proses{id}', [TeknisiUbahStatusProsesServisController::class, 'update'])->name('teknisi-ubah-status-proses-update');
    Route::get('teknisi/servis-ubah-bisa-diambil/{id}', [TeknisiUbahBisaDiambilController::class, 'edit'])->name('teknisi-ubah-bisa-diambil-edit');
    Route::post('teknisi/servis-ubah-bisa-diambil{id}', [TeknisiUbahBisaDiambilController::class, 'update'])->name('teknisi-ubah-bisa-diambil-update');
    Route::get('teknisi/servis-ubah-sudah-diambil/{id}', [TeknisiUbahSudahDiambilController::class, 'edit'])->name('teknisi-ubah-sudah-diambil-edit');
    Route::post('teknisi/servis-ubah-sudah-diambil{id}', [TeknisiUbahSudahDiambilController::class, 'update'])->name('teknisi-ubah-sudah-diambil-update');

    Route::get('teknisi-nota-pengambilan-termal/{id}', [TeknisiSudahDiambilController::class, 'cetaktermal'])->name('teknisi-termal-pengambilan');
});

Route::middleware('ensureSalesRole:Sales')->group(
    function () {
        Route::get('/sales-dashboard', [SalesDashboardController::class, 'index'])->name('sales-dashboard');
        Route::resource('sales-pelanggan', SalesPelangganController::class);
        Route::resource('phone/sales-data-handphone', SalesPhoneController::class);
        Route::resource('phone/sales-phone-terjual', SalesPhoneTerjualController::class);
        Route::resource('phone/sales-transaksi-handphone', SalesTransaksiHandphoneController::class);
        Route::resource('sparepart/sales-data-sparepart', SalesSparepartController::class);
        Route::resource('sparepart/sales-transaksi-sparepart', SalesTransaksiSparepartController::class);
        Route::resource('aksesoris/sales-data-aksesoris', SalesAksesorisController::class);
        Route::resource('aksesoris/sales-transaksi-aksesoris', SalesTransaksiAksesorisController::class);
        Route::resource('sales-pengeluaran', SalesExpenseController::class);
        Route::resource('laporan/sales-laporan-handphone', SalesLaporanHandphoneController::class);
        Route::resource('laporan/sales-laporan-sparepart', SalesLaporanSparepartController::class);
        Route::resource('laporan/sales-laporan-aksesoris', SalesLaporanAksesorisController::class);

        Route::get('sales-nota-sparepart-termal/{id}', [SalesTransaksiSparepartController::class, 'cetaktermal'])->name('sales-nota-sparepart-termal');
        Route::get('sales-nota-handphone-termal/{id}', [SalesTransaksiHandphoneController::class, 'cetaktermal'])->name('sales-nota-handphone-termal');
        Route::get('sales-nota-aksesori-termal/{id}', [SalesTransaksiAksesorisController::class, 'cetaktermal'])->name('sales-nota-aksesori-termal');
    }
);

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    // Route for the getting the data feed
    Route::get('/json-data-feed', [DataFeedController::class, 'getDataFeed'])->name('json_data_feed');

    Route::get('/old-dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
