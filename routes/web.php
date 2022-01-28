<?php

use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\ArtReviewController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PublicGalleryController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('home');
});

Route::post('/sendmail', [MailController::class, 'send']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');

Route::name('admin.')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::resource('galleries', GalleryController::class);
        Route::resource('orders', OrderController::class);
    });
});

Route::get('/galleries', [PublicGalleryController::class, 'index'])->name('galleries.index');
Route::get('/gallery/{gallery:id}', [PublicGalleryController::class, 'show'])->name('galleries.show');
Route::post('/gallery/{gallery:id}', [ArtReviewController::class, 'store'])->name('galleries.store');


Route::get('/carts', [CartController::class, 'index'])->name('carts.index');
Route::get('/carts/add/{gallery:id}', [CartController::class, 'add'])->name('carts.add');
Route::patch('/carts/update', [CartController::class, 'update'])->name('carts.update');
Route::delete('/carts/remove', [CartController::class, 'remove'])->name('carts.remove');