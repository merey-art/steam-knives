<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\KnifeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Livewire\OrderManager;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->middleware('auth')
        ->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])
        ->middleware('auth')
        ->name('checkout.store');
    Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])
        ->middleware('auth')
        ->name('checkout.success');
    Route::resource('categories', CategoryController::class);
    Route::resource('knives',     KnifeController::class);
    Route::get('/catalog', fn() => view('catalog'))->name('catalog');
    Route::get('/catalog/{knife}', [KnifeController::class,'show'])->name('knives.show');
    Route::get('/cart',     fn() => view('cart'))->name('cart');
    Route::middleware(['auth'])->group(function () {
        Route::get('/admin/orders', [\App\Livewire\OrderManager::class])
            ->name('admin.orders');
    });
});

require __DIR__.'/auth.php';
