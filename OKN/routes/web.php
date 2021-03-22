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

Route::view('/about', 'about')->name('about');
Route::get('/home', 'HomeController@index')->name('home');
Route::view('/book', 'book')->name('book');
Route::view('/report', 'report')->name('report');
Route::view('/contact', 'contact')->name('contact');

# TODO: ゲストは /about へ認証済みユーザは /home へリダイレクトさせる
Route::redirect('/', '/home')->name('root');

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
        'incomes' => IncomeController::class,
        'incomeGenres' => IncomeGenreController::class,
    ]);
});
