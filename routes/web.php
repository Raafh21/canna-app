<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\TrainingController;

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
// Route::get('/', function () {
//     return view('index');
// });
Route::group(['middleware' => ['auth']], function () {
  Route::resource('/training', TrainingController::class);
  Route::get('/perhitungan', [PerhitunganController::class, 'index'])->name('perhitungan');
  Route::get('/mining', [PerhitunganController::class, 'mining'])->name('mining');
  Route::get('/pohon', [PerhitunganController::class, 'pohon'])->name('pohon');
  Route::get('/ganti', [DashboardController::class, 'ganti'])->name('ganti');
  Route::get('/admin', [DashboardController::class, 'admin'])->name('admin');
  Route::get('/logout', [DashboardController::class, 'logout'])->name('logout');
  Route::post('/profile/{user}', [DashboardController::class, 'profile_update'])->name('update-password');
});

Route::resource('/riwayat', RiwayatController::class);
Route::get('/{id}/lihat2', [RiwayatController::class, 'see2'])->name('LihatRiwayat');
Route::get('/about', [DashboardController::class, 'about'])->name('about');
Route::get('/klasifikasi', [DashboardController::class, 'klasifikasi'])->name('klasifikasi');
Route::get('/', [DashboardController::class, 'home'])->name('home');

Route::middleware(['guest'])->group(function () {
  // authentication
  Route::get('/login', [DashboardController::class, 'login'])->name('login');
  Route::post('/login-process', [DashboardController::class, 'login_process'])->name('login_process');
});
