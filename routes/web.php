<?php

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ManajemenBukuController;
use App\Http\Controllers\Dashboard\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::get('connect/google', [GoogleController::class, 'connectGoogle'])->name('connect.google');

route::group(['middleware'=>'auth'], function(){
    route::get('google-password-step', [GoogleController::class, 'googlePasswordSet'])->name('google.setup')->middleware('GoogleSetUpSuccess');
    route::post('goole-password-setup', [GoogleController::class, 'setPasswordStore'])->name('google.setup-store');
});

route::group(['middleware' => ['auth', 'GoogleSetUp']], function() {
    route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Managemen Buku
    route::get('manajemen-buku', [ManajemenBukuController::class, 'index'])->name('manajemenBuku');
    route::get('manajemen-buku-json', [ManajemenBukuController::class, 'json'])->name('bukuJson');
    route::get('manajemen-buku-lihat/{id}', [ManajemenBukuController::class, 'lihat'])->name('bukuLihat');
    route::get('manajemen-buku-hapus/{id}', [ManajemenBukuController::class, 'hapus'])->name('bukuHapus');
    route::post('manajemen-buku-add', [ManajemenBukuController::class, 'store'])->name('bukuAdd');
    route::post('manajemen-buku-update', [ManajemenBukuController::class, 'update'])->name('bukuUpdate');
    Route::get('/manajemen-buku-edit/{id}', [ManajemenBukuController::class, 'edit'])->name('bukuEdit');

    // Google SetUp Password
    // 
    route::prefix('dashboard')->group(function() {
        route::get('profile', [ProfileController::class, 'profile'])->name('profile');
        route::post('profile-account', [ProfileController::class, 'updateAccount'])->name('profile.account');

        route::get('profile-security', [ProfileController::class, 'profileSecurity'])->name('profile.security');
        route::post('update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');

        route::get('profile-connections', [ProfileController::class, 'profileConnections'])->name('profile.connections');
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
