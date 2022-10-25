<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerkasController;
use App\Http\Controllers\GedungController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PengelolaanAngaranController;
use App\Http\Controllers\VerifikasiBerkasController;


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



// user
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/user/create', [AuthController::class, 'store'])->name('user-create');
Route::post('/user/login/', [AuthController::class, 'authenticate'])->name('authenticate');

Route::get('/user/form-forgot/password', [AuthController::class, 'forgotPassword'])->name('forgot-password');
Route::post('/user/forgot/password', [AuthController::class, 'sendResetLink'])->name('forgot-password-link');
Route::get('/password/reset/{token}', [AuthController::class, 'showResetForm'])->name('reset-password-form');
Route::post('/password/reset', [AuthController::class, 'resetPassword'])->name('reset-password');
// ------------------------


Route::group(['middleware' => ['auth', 'accesscontrol:superadmin,admin']], function () {

  // dashboard 
  Route::get('/dashboard', function () {
    $pegawai = PegawaiController::hitung();
    $gedung = GedungController::hitung();
    $berkas = BerkasController::hitung();
    $verifikasi = VerifikasiBerkasController::hitung();
    return view('dashboard', compact('pegawai', 'gedung', 'berkas', 'verifikasi'));
  });

  // -----------------------------------

  Route::get('/user/profile', [AuthController::class, 'profile'])->name('user-profile');
  Route::put('/user/profile/edit/{id}', [AuthController::class, 'editProfile'])->name('user-profile-edit');
  Route::delete('/user/profile/delete/{id}', [AuthController::class, 'deleteProfile'])->name('user-profile-delete');

  // user
  Route::get('/user', [AuthController::class, 'index'])->name('index-user');
  Route::put('/user/update/{id}', [AuthController::class, 'update'])->name('update-user');
  Route::put('/user/roleupdate/{id}', [AuthController::class, 'roleUpdate'])->name('role-update-user');
  Route::delete('/user/delete/{id}', [AuthController::class, 'delete'])->name('delete-user');
  Route::post('/user/logout', [AuthController::class, 'logout'])->name('user-logout');
  // fitur print pdf 
  Route::get('/user-pdf', [AuthController::class, 'printPDF'])->name('user-pdf');

  // -----------------------------------

  // Rourte Pegawai
  Route::get('/pegawai', [PegawaiController::class, 'index'])->name('index-pegawai');
  Route::post('/pegawai/create', [PegawaiController::class, 'create'])->name('create-pegawai');
  Route::put('/pegawai/update/{id}', [PegawaiController::class, 'update'])->name('update-pegawai');
  Route::delete('/pegawai/delete/{id}', [PegawaiController::class, 'delete'])->name('delete-pegawai');
  // fitur export excel pegawai
  Route::get('/exportexcelpegawai', [PegawaiController::class, 'exportToEcxel'])->name('export-to-excel-pegawai');
  // fitur print pdf pegawai
  Route::get('/print-pegawai', [PegawaiController::class, 'printTable'])->name('print-table-pegawai');

  // ------------------------------------

  // Route pengelolaan
  Route::get('/pengelolaan', [PengelolaanAngaranController::class, 'index'])->name('pengelolaan-angaran');
  Route::get('/pengelolaan/exportexcel', [PengelolaanAngaranController::class, 'exportExcel'])->name('export-excel');
  Route::post('/pengelolaan/importexcel', [PengelolaanAngaranController::class, 'importExcel'])->name('import-excel');

  // ------------------------------------

  // Route Berkas
  Route::get('/berkas', [BerkasController::class, 'index'])->name('index-berkas');
  Route::post('/berkas/create', [BerkasController::class, 'create'])->name('create-berkas');
  Route::put('/berkas/update/{id}', [BerkasController::class, 'update'])->name('update-berkas');
  Route::delete('/berkas/delete/{id}', [BerkasController::class, 'delete'])->name('delete-berkas');

  // ------------------------------------

  // Route Verifikasi Berkas 
  Route::get('/verifikasi', [VerifikasiBerkasController::class, 'index'])->name('index-verifikasi');
  Route::get('/verifikasi/show/{id}', [VerifikasiBerkasController::class, 'show'])->name('show-verifikasi');
  Route::put('/verifikasi/update/{id}', [VerifikasiBerkasController::class, 'update'])->name('update-verifikasi');
  Route::delete('/verifikasi/{id}', [VerifikasiBerkasController::class, 'delete'])->name('delete-verifikasi');
  // fitur export excel Verifikasi
  Route::get('/exportverifikasi', [VerifikasiBerkasController::class, 'exportToEcxel'])->name('export-to-excel-verifikasi');
  // fitur print Verifikasi
  Route::get('/printverifikasi', [VerifikasiBerkasController::class, 'printTable'])->name('print-table-verifikasi');

  // --------------------------------------

  // Route Gedung
  Route::get('/gedung', [GedungController::class, 'index'])->name('index-gedung');
  Route::post('/gedung/create', [GedungController::class, 'create'])->name('create-gedung');
  Route::put('/gedung/update/{id}', [GedungController::class, 'update'])->name('update-gedung');
  Route::delete('/gedung/delete/{id}', [GedungController::class, 'delete'])->name('delete-gedung');
});