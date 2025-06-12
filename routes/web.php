<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AkunUsersController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenumpangController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\HalamanPelangganController;

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('/dashboard', function () {
//     return view('dashboard');
// });

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



Route::resource('admin', AdminController::class);

Route::resource('customer', CustomerController::class);

Route::resource('pembayaran', PembayaranController::class);

Route::resource('penumpang', PenumpangController::class);

Route::resource('reservasi', ReservasiController::class);

Route::resource('pakets', PaketController::class);
Route::resource('pesanan', PesananController::class);




Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');


Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');

Route::get('/pelanggan/reservasi', [HalamanPelangganController::class, 'index'])->name('pelanggan.reservasi');
Route::post('/pelanggan/reservasi', [HalamanPelangganController::class, 'store'])->name('pelanggan.store');
Route::get('/dashboard-pelanggan', [HalamanPelangganController::class, 'dashboard'])->name('dashboardpelanggan');


Route::get('/', [LandingController::class, 'index'])->name('landing.page');

//admin
Route::middleware(['auth'])->group(function () {
    Route::get('/pengaturan-akun', [UserController::class, 'edit'])->name('akunadmin.edit');
    Route::put('/pengaturan-akun', [UserController::class, 'update'])->name('akunadmin.update'); // ganti dari POST ke PUT
    Route::get('/akun', [UserController::class, 'index'])->name('akun.index');
});


//user
Route::middleware('auth')->group(function () {
Route::get('/akunuser', [AkunUsersController::class, 'index'])->name('akun.profile');
    Route::get('/akunuser/edit', [AkunUsersController::class, 'editProfile'])->name('akun.edit');
    Route::put('/akunuser/update', [AkunUsersController::class, 'updateProfile'])->name('akun.update');

});

