<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ConcertController;
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

// Concert Routes
Route::post('concert', [ConcertController::class, 'store'])->name('concert');
Route::get('concert', [ConcertController::class, 'create'])->name('concert.create');
Route::post('concert-search', [ConcertController::class, 'searchDate'])->name('concert.search');

Route::get('/concert-list', [ConcertController::class, 'concertsList'])->name('concert.list');

// Order Concerts
Route::get('/concert-order/{id}', [DetailOrderController::class, 'create'])->name('concert.order');
Route::post('/concert-order/{id}', [DetailOrderController::class, 'store'])->name('concert.order.pay');
Route::get('/my-concerts', [ConcertController::class, 'myConcerts'])->name('client.concerts');
