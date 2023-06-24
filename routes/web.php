<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ConcertController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DetailOrderController;

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
})->name('home');


// Register Routes
Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

// Login Routes
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');


Route::get('/dashboard', [ConcertController::class, 'index'])->name('dashboard');

Route::middleware(['routesAdmin'])->group(function () {

    // Images
    Route::post('/images', [ImageController::class, 'store'])->name('images.store');

    // Concert Routes
    Route::post('concert', [ConcertController::class, 'store'])->name('concert');
    Route::get('concert', [ConcertController::class, 'create'])->name('concert.create');

    Route::get('/concerts', [ConcertController::class, 'allConcerts'])->name('concerts');
    Route::get('/concert-clients/{id}', [ConcertController::class, 'concertClients'])->name('concert.clients');

    // Search Client
    Route::get('/client-search', [ConcertController::class, 'searchClient'])->name('client.search');
});


Route::middleware(['routesClient'])->group(function () {


    Route::post('concert-search', [ConcertController::class, 'searchDate'])->name('concert.search');
    Route::get('/concert-list', [ConcertController::class, 'concertsList'])->name('concert.list');

    // Detail Concerts
    Route::get('/concert-order/{id}', [DetailOrderController::class, 'create'])->name('concert.order');
    Route::post('/concert-order/{id}', [DetailOrderController::class, 'store'])->name('concert.order.pay');
    Route::get('/my-concerts', [ConcertController::class, 'myConcerts'])->name('client.concerts');

    // Voucher
    Route::get('/detail-order/{id}', [VoucherController::class, 'generatePDF'])->name('generate.pdf');
});

Route::get('/edit-profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/edit-profile', [ProfileController::class, 'store'])->name('profile.store');

// Voucher
Route::get('descargar-pdf/{id}', [VoucherController::class, 'downloadPDF'])->name('pdf.descargar');
