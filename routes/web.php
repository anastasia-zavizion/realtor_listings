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

Route::prefix('realtor')->name('realtor.')->middleware(['auth','verified'])->group(function () {
    Route::resource('listing', \App\Http\Controllers\RealtorListingController::class)->withTrashed();
    Route::put('listing/restore/{listing}', [\App\Http\Controllers\RealtorListingController::class, 'restore'])->name('listing.restore')->withTrashed();

    Route::resource('listing.image', \App\Http\Controllers\ListingImageController::class)->only(['create', 'store', 'destroy']);

    Route::name('offer.accept')->put('offer/{offer}/accept', \App\Http\Controllers\RealtorListingAcceptOfferController::class);

});


Route::get('/email/verify/{id}/{hash}', function (\Illuminate\Foundation\Auth\EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('listing.index')->with('success','Email was verified');
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::post('/email/verification-notification', function (Illuminate\Http\Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('success', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('email/verify', function (){

    return inertia('Auth/VerifyEmail');

})->middleware('auth')->name('verification.notice');




Route::resource('listing.offer', \App\Http\Controllers\ListingOfferController::class)->only(['store']);

Route::name('notification.seen')->put('notification/{notification}/seen', \App\Http\Controllers\NottificationSeenController::class)->middleware('auth');


