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

Route::get('/',[\App\Http\Controllers\ListingController::class, 'index']);
Route::get('/hello',[\App\Http\Controllers\IndexController::class, 'index']);
Route::resource('listing', \App\Http\Controllers\ListingController::class)->except(['destroy']);

Route::get('login', [AuthController::class, 'create'])->name('login');
Route::post('login', [AuthController::class, 'store'])->name('login.store');
Route::delete('logout', [AuthController::class, 'destroy'])->name('logout');

Route::resource('user-account', \App\Http\Controllers\UserAccountController::class)->only(['create', 'store']);


/*Route::prefix('realtor')->name('realtor.')->middleware('auth')->group(function (){
    Route::resource('listing', \App\Http\Controllers\RealtorListingController::class)->only(['index', 'destroy']);
});*/


Route::resource('realtor', \App\Http\Controllers\RealtorListingController::class)->only(['index', 'destroy']);

