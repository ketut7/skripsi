<?php

use Illuminate\Support\Facades\Route;

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
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\ContentController;


Route::get('/', function () {
    return view('home');
})->name('home');

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::resource('/produk', ProdukController::class);
Route::get('/login', [AuthenticationController::class, 'login'])->name('login');
Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');
Route::post('/login', [AuthenticationController::class, 'loginAction']);
Route::get('/register', [AuthenticationController::class, 'register'])->name('register');
Route::post('/register', [AuthenticationController::class, 'registerAction']);

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/keranjang', [TransaksiController::class, 'keranjang'])->name('keranjang.index');
Route::delete('/keranjang/{keranjang}', [TransaksiController::class, 'hapusItemKerajang'])->name('keranjang.destroy');
Route::post('/transaksi/cart', [TransaksiController::class, 'tambahKeranjang'])->name('tambah_keranjang');
Route::post('/transaksi/checkout', [TransaksiController::class, 'checkout'])->name('checkout');
Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
Route::get('/transaksi/{transaksi}', [TransaksiController::class, 'show'])->name('transaksi.show');
Route::post('/transaksi/{transaksi}/konfirmasi-pembayaran', [TransaksiController::class, 'konfirmasiPembayaran'])->name('konfirmasi.pembayaran');


Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', function () {
        return view('admin.login');
    });
    Route::post('/', [\App\Http\Controllers\Admin\AuthenticationController::class, 'loginAction'])->name('login');
    Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::resource('/produk', \App\Http\Controllers\Admin\ProdukController::class);
        Route::resource('/transaksi', \App\Http\Controllers\Admin\TransaksiController::class);
    });
});
//require __DIR__.'/auth.php';x
