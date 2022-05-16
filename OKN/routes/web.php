<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
