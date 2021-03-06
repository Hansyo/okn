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


Route::get('/', 'HomeController@index')->name('home');

Route::redirect('/home', '/');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


# 各種コントローラーに対してCRUD処理できるリソースを張る
Route::group(['middleware' => ['auth',]], function () {
    Route::resources([
        'receipts' => ReceiptController::class,
        'genres' => GenreController::class,
        'stores' => StoreController::class,
        'paymentGenres' => PaymentGenreController::class,
        'payments' => PaymentController::class,
        'presets' => PresetController::class,
        'creditHistories' => CreditHistoryController::class,
        'incomeGenres' => IncomeGenreController::class,
    ]);
});
