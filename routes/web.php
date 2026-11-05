<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| FRONTEND (Publik)
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PublicSectorController;
use App\Http\Controllers\Frontend\PublicNewsController;

use App\Http\Controllers\Front\ProfileController as PublicProfileController;
use App\Http\Controllers\Front\StructureController as PublicStructureController;
use App\Http\Controllers\Front\AnnouncementController as PublicAnnouncementController;
use App\Http\Controllers\Front\ReportController;

/*
|--------------------------------------------------------------------------
| ADMIN (Backend)
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SectorController as AdminSectorController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\MetricController as AdminMetricController;
use App\Http\Controllers\Admin\LeaderController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\AnnouncementController as AdminAnnouncementController;
use App\Http\Controllers\Admin\VillageController;
use App\Http\Controllers\Admin\DinasSectorController;
use App\Http\Controllers\ExportPdfController;

// OPD schema-driven (terhubung desa)
use App\Http\Controllers\Admin\OpdRecordController;
use App\Http\Controllers\Admin\VillageOpdPickerController;

use App\Http\Controllers\Esdm\DesaReportController;
use App\Http\Controllers\Esdm\AdminSdaController;
use App\Http\Controllers\Esdm\PimpinanController;
use App\Http\Controllers\Esdm\VillageAccountController;

/* ===================== FRONTEND ===================== */

// ✅ Intro jadi halaman pertama (root)
Route::get('/', function () {
    return view('front.intro'); // resources/views/front/intro.blade.php
})->name('intro');

// Beranda utama dipindah ke /home
Route::get('/home', [HomeController::class, 'index'])->name('home');

/* Pelaporan Publik */
Route::prefix('report')->name('report.')->group(function () {
    Route::get('emergency',  [ReportController::class, 'createEmergency'])->name('emergency.create');
    Route::post('emergency', [ReportController::class, 'storeEmergency'])->name('emergency.store');

    Route::get('assistance',  [ReportController::class, 'createAssistance'])->name('assistance.create');
    Route::post('assistance', [ReportController::class, 'storeAssistance'])->name('assistance.store');
});

/* Riwayat */
Route::prefix('riwayat')->name('report.history.')->group(function () {
    Route::get('laporan-mendesak',   [ReportController::class, 'historyEmergency'])->name('emergency');
    Route::get('permohonan-bantuan', [ReportController::class, 'historyAssistance'])->name('assistance');
});

/* Sektor (publik) */
// Halaman gabungan: sektor desa + sektor OPD (untuk menu navbar "Sektor/Potensi")
Route::get('/potensi', [PublicSectorController::class, 'indexAll'])->name('sectors.all');

// Daftar & detail sektor desa (tetap ada)
Route::get('/sectors',               [PublicSectorController::class, 'index'])->name('sectors.index');
Route::get('/sectors/{sector:slug}', [PublicSectorController::class, 'show'])->name('sectors.show');
// Detail publik Sektor OPD (read-only)
Route::get('/potensi/opd/{opd:slug}', [\App\Http\Controllers\Frontend\PublicSectorController::class, 'opdShow'])
    ->name('opd.public.show');
/* Berita (publik) */
Route::get('/news',        [PublicNewsController::class, 'index'])->name('news.index');
Route::get('/news/{news}', [PublicNewsController::class, 'show'])->name('news.show');

/* Pengumuman (publik) */
Route::get('/pengumuman',                [PublicAnnouncementController::class, 'index'])->name('ann.index');
Route::get('/pengumuman/{announcement}', [PublicAnnouncementController::class, 'show'])->name('ann.show');

/* Profil & Struktur (publik) */
Route::get('/profil',              [PublicProfileController::class, 'show'])->name('profile.show');
Route::get('/struktur-organisasi', [PublicStructureController::class, 'show'])->name('structure.show');


/* ===================== ADMIN (auth) ===================== */
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    /* Dashboard */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /* Master/Konten */
    Route::resource('sliders',       SliderController::class);
    Route::resource('news',          AdminNewsController::class);
    Route::resource('sectors',       AdminSectorController::class);
    Route::resource('metrics',       AdminMetricController::class)->only(['index','edit','update']);
    Route::resource('leaders',       LeaderController::class);
    Route::resource('employees',     EmployeeController::class);
    Route::resource('announcements', AdminAnnouncementController::class);


Route::get('/export/sektor', [ExportPdfController::class, 'sektor'])->name('export.sektor');
Route::get('/export/dinas', [ExportPdfController::class, 'dinas'])->name('export.dinas');
    Route::get('sectors/{sector}/villages/{village}/pdf', [ExportPdfController::class, 'villageOne'])
        ->name('sectors.villages.pdf');
     Route::get('opd/{dinasSector}/pdf', [ExportPdfController::class, 'opdByDinas'])
        ->name('opd.pdf');


    /* Dinas/OPD (kamus OPD + schema) */
    Route::resource('dinas-sectors', DinasSectorController::class);

    /*
    |--------------------------------------------------------------------------
    | Desa per Sector (umum) – gunakan slug model Sector kamu
    |--------------------------------------------------------------------------
    */
    Route::get( 'sectors/{sector:slug}/villages',        [VillageController::class, 'index'])->name('sectors.villages.index');
    Route::get( 'sectors/{sector:slug}/villages/create', [VillageController::class, 'create'])->name('sectors.villages.create');
    Route::post('sectors/{sector:slug}/villages',        [VillageController::class, 'store'])->name('sectors.villages.store');

    // shallow villages
    Route::get(   'villages/{village}/edit', [VillageController::class, 'edit'])->name('villages.edit');
    Route::put(   'villages/{village}',      [VillageController::class, 'update'])->name('villages.update');
    Route::delete('villages/{village}',      [VillageController::class, 'destroy'])->name('villages.destroy');

    /*
    |--------------------------------------------------------------------------
    | OPD schema-driven TERHUBUNG DESA (pakai DinasSector::slug)
    | A) Picker OPD untuk DESA → dari halaman daftar desa
    | B) Picker DESA untuk OPD → dari halaman OPD
    | C) CRUD record OPD per desa
    |--------------------------------------------------------------------------
    */

    // A) dari daftar Desa: pilih OPD mana yang akan diisi untuk desa tsb
    Route::get('sectors/{sector:slug}/villages/{village}/opd',
        [VillageOpdPickerController::class, 'picker']
    )->name('sectors.villages.opd.picker');

    // B) dari halaman OPD: pilih Desa yang akan diinput (opsional)
    Route::get('opd/{sector:slug}/villages/pick',
        [OpdRecordController::class, 'pickVillage']
    )->name('opd.villages.pick');

    // OPD index (list data; support filter ?village_id=&tahun= )
    Route::get('opd/{sector:slug}',
        [OpdRecordController::class, 'index']
    )->name('opd.index');

    


    // C) create/store data OPD untuk DESA tertentu
    Route::get('opd/{sector:slug}/villages/{village}/create',
        [OpdRecordController::class, 'create']
    )->name('opd.create');

    Route::post('opd/{sector:slug}/villages/{village}',
        [OpdRecordController::class, 'store']
    )->name('opd.store');

    // edit/update data OPD
    Route::get('opd/records/{record}/edit',
        [OpdRecordController::class, 'edit']
    )->name('opd.edit');

    Route::put('opd/records/{record}',
        [OpdRecordController::class, 'update']
    )->name('opd.update');
});

/* /admin → /admin/dashboard */
Route::redirect('/admin', '/admin/dashboard')->middleware('auth');

/* ===================== ESDM MODULE ===================== */

// Admin Desa - Input laporan ESDM (mobile-friendly)
Route::prefix('esdm/desa')->name('esdm.desa.')->middleware(['auth', 'role:admin_desa'])->group(function () {
    Route::get('/', [DesaReportController::class, 'dashboard'])->name('dashboard');
    Route::get('/laporan/buat/{type}', [DesaReportController::class, 'create'])->name('report.create');
    Route::post('/laporan', [DesaReportController::class, 'store'])->name('report.store');
    Route::get('/laporan/{report}', [DesaReportController::class, 'show'])->name('report.show');
    Route::get('/laporan/{report}/edit', [DesaReportController::class, 'edit'])->name('report.edit');
    Route::put('/laporan/{report}', [DesaReportController::class, 'update'])->name('report.update');
});

// Admin Bagian SDA - Verifikasi & monitoring
Route::prefix('esdm/admin')->name('esdm.admin.')->middleware(['auth', 'role:admin_sda,admin'])->group(function () {
    Route::get('/', [AdminSdaController::class, 'dashboard'])->name('dashboard');
    Route::get('/laporan', [AdminSdaController::class, 'index'])->name('report.index');
    Route::get('/laporan/{report}', [AdminSdaController::class, 'show'])->name('report.show');
    Route::post('/laporan/{report}/verify', [AdminSdaController::class, 'verify'])->name('report.verify');
    Route::post('/laporan/{report}/status', [AdminSdaController::class, 'updateStatus'])->name('report.status');

    // Manajemen Akun Admin Desa
    Route::post('/desa-accounts/generate-all', [VillageAccountController::class, 'generateAll'])->name('desa-accounts.generate-all');
    Route::post('/desa-accounts/{user}/reset-password', [VillageAccountController::class, 'resetPassword'])->name('desa-accounts.reset-password');
    Route::resource('desa-accounts', VillageAccountController::class)->parameters(['desa-accounts' => 'desa_account'])->except(['show']);
});

// Pimpinan - Monitoring read-only
Route::prefix('esdm/pimpinan')->name('esdm.pimpinan.')->middleware(['auth', 'role:pimpinan,admin'])->group(function () {
    Route::get('/', [PimpinanController::class, 'dashboard'])->name('dashboard');
    Route::get('/laporan', [PimpinanController::class, 'index'])->name('report.index');
    Route::get('/laporan/{report}', [PimpinanController::class, 'show'])->name('report.show');
});

/* Auth scaffolding */
require __DIR__.'/auth.php';
