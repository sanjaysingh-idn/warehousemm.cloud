<?php

use App\Models\Bukutamu;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WarnaController;
use App\Http\Controllers\DesainController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\BukutamuController;
use App\Http\Controllers\SecurityController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\KoordinatorController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\PackingListController;
use App\Http\Controllers\SopirController;

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

Route::get('/', function () {
    return view('dashboard.auth.login');
});
Route::get('/pengajuan-akun', function () {
    return view('dashboard.layouts.register');
});
Route::post('/pengajuan/store', [PengajuanController::class, 'store'])->name('pengajuan.store');
Route::get('/404', function () {
    return view('404');
})->name('404');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::middleware(['auth', 'checkRole:superadmin,manager'])->group(function () {
        Route::get('/pengajuan/index', [PengajuanController::class, 'index'])->name('pengajuan.index');
    });
    Route::get('kain/data', [KainController::class, 'getData'])->name('kain.data');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::patch('/kain/{id}/update-status', [KainController::class, 'updateStatus'])->name('kain.updateStatus');
    Route::get('/kain/keluar', [KainController::class, 'kainKeluar'])->name('kain.keluar');
    Route::get('/kain/keluar/create', [KainController::class, 'kainKeluarCreate'])->name('kain.keluar.create');
    Route::post('/kain/keluar/store', [KainController::class, 'kainKeluarStore'])->name('kain.keluar.store');
    Route::resource('user', UserController::class);
    Route::resource('kain', KainController::class);
    Route::resource('warna', WarnaController::class);
    Route::resource('driver', DriverController::class);
    Route::resource('sopir', SopirController::class);
    Route::resource('mobil', MobilController::class);
    Route::get('/kain/{kain}/warna', [WarnaController::class, 'index'])->name('kain.warna.list');
    Route::get('/kain/{kain}/barcode', [KainController::class, 'cetakBarcode'])->name('kain.barcode');
    Route::post('/kain/search', [KainController::class, 'searchById'])->name('kain.search');
    Route::get('/kain/{kain}/warna/{warna}/pcs', [WarnaController::class, 'pcsList'])->name('kain.warna.pcs.list');
    Route::post('/pcs/store', [WarnaController::class, 'pcsStore'])->name('pcs.store');
    Route::resource('supplier', SupplierController::class);
    Route::resource('security', SecurityController::class);
    Route::resource('koordinator', KoordinatorController::class);
    Route::resource('bukutamu', BukutamuController::class);
    Route::delete('/pcs/{id}', [WarnaController::class, 'pcsDelete'])->name('pcs.destroy');
    Route::put('/pcs/{id}', [WarnaController::class, 'pcsUpdate'])->name('pcs.update');

    // Dropdown
    Route::get('/get-warna-options/{kain_id}', [PackingListController::class, 'getWarnaOptions']);
    Route::get('/get-pcs-options/{warna_id}', [PackingListController::class, 'getPcsOptions']);


    // Packing List
    Route::get('packingList/createManual', [PackingListController::class, 'createManual'])->name('packingList.createManual');
    Route::resource('packingList', PackingListController::class);
    Route::post('packingList/storeManual', [PackingListController::class, 'storeManual'])->name('packingList.storeManual');
    Route::get('/laporanPackingList', [PackingListController::class, 'laporan'])->name('laporanPackingList');
    Route::post('/laporanPackingList/generate-report-packingList', [PackingListController::class, 'generatePackingListReport'])->name('laporanPackingList.generate-report-packingList');
    Route::get('/generate-packcingList-pdf', [PackingListController::class, 'generatePackingListReportPDF'])->name('generate-packcingList-pdf');
    Route::get('/generatePDF/{id}', [PackingListController::class, 'generatePDF'])->name('generatePDF');
    Route::post('/cart/add', [PackingListController::class, 'addToCart']);

    // Backup Database
    Route::get('/backup-database', [DashboardController::class, 'backup'])->name('backup.database');

    // PDF
    Route::get('/laporanTamu', [BukutamuController::class, 'laporan'])->name('laporanTamu');
    Route::get('/pilihkategori', [KainController::class, 'pilihkategori'])->name('pilihkategori');
    Route::get('/stoklama/{kategori}', [KainController::class, 'stoklama'])->name('stoklama');
    Route::post('/laporanTamu/generate-report-tamu', [BukutamuController::class, 'generateTamuReport'])->name('laporanTamu.generate-report-tamu');
    Route::get('/generate-tamu-pdf', [BukutamuController::class, 'generateTamuReportPDF'])->name('generate-tamu-pdf');
    Route::get('/laporanKain', [KainController::class, 'laporan'])->name('laporanKain');
    Route::get('/laporanPerKain/{kain}', [KainController::class, 'laporanPerKain'])->name('laporanPerKain');
    Route::post('/laporanKain/generate-report-kain', [KainController::class, 'generateKainReport'])->name('laporanKain.generate-report-kain');
    Route::post('/laporanKain/generate-report-kain-nama', [KainController::class, 'generateKainReportNamaPDF'])->name('laporanKain.generate-report-kain-nama');
    Route::post('/laporanKain/generate-report-kain-keluar', [KainController::class, 'generateKainReportKeluar'])->name('laporanKain.generate-report-kain-keluar');
    Route::get('/generate-kain-pdf', [KainController::class, 'generateKainReportPDF'])->name('generate-kain-pdf');
});
