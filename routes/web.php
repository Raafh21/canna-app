<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
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

Route::get('/', [DashboardController::class, 'home'])->name('home');
Route::get('/about', [DashboardController::class, 'about'])->name('about');



Route::get('/klasifikasi', [DashboardController::class, 'klasifikasi'])->name('klasifikasi');

Route::get('/admin', [DashboardController::class, 'admin'])->name('admin');
Route::get('/training', [TrainingController::class, 'index']);
// Route::get('/about', function () {
//     return view('about');
// });


Route::get('/login', [loginController::class, 'index'])->name('login');
Route::post('/login', [loginController::class, 'admin'])->name('admin');

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [DashboardController::class, 'login'])->name('login');
    Route::post('/login-process', [DashboardController::class, 'login_process'])->name('login_process');
  });