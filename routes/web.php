<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::resource('posts', PostController::class)->middleware('auth');

Route::post('/comment/{post}', [CommentController::class, 'store'])->middleware('auth')->name('comments.store');

Route::get('/products', [ProductController::class, 'index'])->middleware('auth')->name('products.index');

Route::controller(CartController::class)
    ->middleware('auth')
    ->prefix('/cart')
    ->name('cart.')
    ->group(function () {
        Route::post('/add/{product}', 'add')->name('add');
        Route::get('/', 'view')->name('checkout');
        Route::post('/clear', 'clear')->name('clear');
        Route::post('/update', 'update')->name('update');
    });


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
