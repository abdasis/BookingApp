<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\WahanaBookingController;
use App\Http\Controllers\WahanaController;
use App\Http\Controllers\WhatsappController;
use Illuminate\Support\Facades\Route;

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider and all of them will
 * | be assigned to the "web" middleware group. Make something great!
 * |
 */

Route::get('/', function () {
	return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::GET('booking-payment/{id}', [BookingController::class, 'BookingPayment'])->name('booking.book-payment');
Route::post('update/{id}', [BookingController::class, 'update'])->name('booking.update');
Route::group(['middleware' => ['auth']], function () {
	Route::resource('roles', RoleController::class);
	Route::resource('users', UserController::class);
	Route::resource('products', ProductController::class);
	Route::get('vouchers/all', [VoucherController::class, 'all'])->name('vouchers.all');
	Route::get('vouchers/{code}', [VoucherController::class, 'getVoucher'])->name('vouchers.getVocher');
	Route::resource('voucher', VoucherController::class);
	Route::get('daftar-wahana', [WahanaController::class, 'daftarWahana'])->name('wahana.daftarWahana');
	Route::get('semua-wahana', [WahanaController::class, 'all'])->name('wahana.all');
	Route::get('booking-wahana/{id}', [WahanaController::class, 'booking'])->name('wahana.book');
	Route::post('booking-wahana', [WahanaController::class, 'storeBooking'])->name('wahana.store-booking');
	Route::resource('wahana', WahanaController::class);
	Route::resource('wahana-booking', WahanaBookingController::class);
});
Route::prefix('master-room')->group(function () {
	Route::GET('/', [RoomController::class, 'index'])->name('room.index');
	Route::GET('get-room', [RoomController::class, 'getroom'])->name('room.getroom');
	Route::GET('/jenis-kamar', [RoomController::class, 'roomtype'])->name('room.roomtype');
	Route::GET('create', [RoomController::class, 'create'])->name('room.create');
	Route::POST('store', [RoomController::class, 'store'])->name('room.store');
	Route::POST('addType', [RoomController::class, 'addType'])->name('room.addType');
	Route::GET('show/{id}', [RoomController::class, 'show'])->name('room.show');
	Route::GET('detail/{id}', [RoomController::class, 'detail'])->name('room.detail');
	Route::GET('show-jenis-kamar/{id}', [RoomController::class, 'showType'])->name('room.showType');
	Route::get('edit/{id}', [RoomController::class, 'edit'])->name('room.edit');
	Route::get('edit-jenis-kamar/{id}', [RoomController::class, 'editType'])->name('room.editType');
	Route::delete('destroy/{id}', [RoomController::class, 'destroy'])->name('room.destroy');
	Route::delete('destroy-jenis-kamar/{id}', [RoomController::class, 'destroyType'])->name('room.destroyType');
	Route::put('update/{id}', [RoomController::class, 'update'])->name('room.update');
	Route::put('update-jenis-kamar/{id}', [RoomController::class, 'updateType'])->name('room.updateType');
});
Route::prefix('booking')->group(function () {
	Route::GET('/daftar-kamar', [BookingController::class, 'index'])->name('booking.index');
	Route::GET('list', [BookingController::class, 'listBooking'])->name('booking.listBooking');
	Route::GET('create/{id}', [BookingController::class, 'create'])->name('booking.create');
	Route::POST('store', [BookingController::class, 'store'])->name('booking.store');
	Route::POST('onlinestore', [BookingController::class, 'onlinestore'])->name('booking.onlinestore');
	Route::get('edit/{id}', [BookingController::class, 'edit'])->name('booking.edit');
	Route::get('getBukti/{id}', [BookingController::class, 'getBukti'])->name('booking.getBukti');
	Route::delete('destroy/{id}', [BookingController::class, 'destroy'])->name('booking.destroy');
	Route::post('konfirmasi/{id}', [BookingController::class, 'konfirmasi'])->name('booking.konfirmasi');
	Route::post('checkout', [BookingController::class, 'checkout'])->name('booking.checkout');
	Route::GET('booking/{id}', [BookingController::class, 'BookingOnline'])->name('booking.online');
	Route::GET('loginuser', [BookingController::class, 'loginuser'])->name('booking.loginuser');

	//
});
Route::prefix('fasilitas')->group(function () {
	Route::GET('/', [FasilitasController::class, 'index'])->name('fasilitas.index');
	Route::GET('create', [FasilitasController::class, 'create'])->name('fasilitas.create');
	Route::POST('store', [FasilitasController::class, 'store'])->name('fasilitas.store');
	Route::GET('show/{id}', [FasilitasController::class, 'show'])->name('fasilitas.show');
	Route::get('edit/{id}', [FasilitasController::class, 'edit'])->name('fasilitas.edit');
	Route::delete('destroy/{id}', [FasilitasController::class, 'destroy'])->name('fasilitas.destroy');
	Route::put('update/{id}', [FasilitasController::class, 'update'])->name('fasilitas.update');
});
Route::get('client/booking/{id}', [BookingController::class, 'BookingOnline'])->name('booking.online');

Route::group(['middleware' => ['auth']], function () {
	Route::prefix('client')->group(function () {
		Route::GET('payment', [BookingController::class, 'show'])->name('booking.payment');
		Route::get('payment/list/', [BookingController::class, 'show'])->name('booking.show');
		Route::delete('destroy/{id}', [BookingController::class, 'destroy'])->name('booking.destroy');
	});
});
Route::prefix('laporan')->group(function () {
	Route::GET('/', [LaporanController::class, 'index'])->name('laporan.index');
	Route::POST('cetak-laporan', [LaporanController::class, 'cetakLaporan'])->name('laporan.cetak');
	Route::get('/filter-laporan', [LaporanController::class, 'filter'])->name('laporan.filter');
});
Route::prefix('whatsapp')->group(function () {
	Route::GET('/', [WhatsappController::class, 'index'])->name('whatsapp.index');
	Route::POST('store', [WhatsappController::class, 'store'])->name('whatsapp.store');
	Route::delete('destroy/{id}', [WhatsappController::class, 'destroy'])->name('whatsapp.destroy');
});
