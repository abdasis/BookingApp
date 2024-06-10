<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

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

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
});
Route::prefix('master-room')->group(function () {
    Route::GET('/', [RoomController::class, 'index'])->name('room.index');
    Route::GET('create', [RoomController::class, 'create'])->name('room.create');
    Route::POST('store', [RoomController::class, 'store'])->name('room.store');
    Route::GET('show/{id}', [RoomController::class, 'show'])->name('room.show');
    Route::get('edit/{id}', [RoomController::class, 'edit'])->name('room.edit');
    Route::delete('destroy/{id}', [RoomController::class, 'destroy'])->name('room.destroy');
    Route::put('update/{id}', [RoomController::class, 'update'])->name('room.update');
});
Route::prefix('booking')->group(function () {
    Route::GET('/', [BookingController::class, 'index'])->name('booking.index');
    Route::GET('create', [BookingController::class, 'create'])->name('booking.create');
    Route::POST('store', [BookingController::class, 'store'])->name('booking.store');
    Route::GET('show/{id}', [BookingController::class, 'show'])->name('booking.show');
    Route::get('edit/{id}', [BookingController::class, 'edit'])->name('booking.edit');
    Route::delete('destroy/{id}', [BookingController::class, 'destroy'])->name('booking.destroy');
    Route::put('update/{id}', [BookingController::class, 'update'])->name('booking.update');
});
