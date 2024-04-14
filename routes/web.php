<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::get('/', [\App\Http\Controllers\ListingController::class, 'index']);
Route::get('/hello', [\App\Http\Controllers\IndexController::class, 'index']);
Route::resource('listing', \App\Http\Controllers\ListingController::class)->only(['index', 'show']);

Route::get('login', [AuthController::class, 'create'])->name('login');
Route::post('login', [AuthController::class, 'store'])->name('login.store');
Route::delete('logout', [AuthController::class, 'destroy'])->name('logout');

Route::resource('user-account', \App\Http\Controllers\UserAccountController::class)->only(['create', 'store']);


Route::resource('notification', \App\Http\Controllers\NotificationController::class)->middleware('auth')->only(['index']);

Route::prefix('realtor')->name('realtor.')->middleware('auth')->group(function () {
    Route::resource('listing', \App\Http\Controllers\RealtorListingController::class)->withTrashed();
    Route::put('listing/restore/{listing}', [\App\Http\Controllers\RealtorListingController::class, 'restore'])->name('listing.restore')->withTrashed();

    Route::resource('listing.image', \App\Http\Controllers\ListingImageController::class)->only(['create', 'store', 'destroy']);

    Route::name('offer.accept')->put('offer/{offer}/accept', \App\Http\Controllers\RealtorListingAcceptOfferController::class);

});

Route::resource('listing.offer', \App\Http\Controllers\ListingOfferController::class)->only(['store']);


