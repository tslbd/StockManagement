<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::resource('/dashboard/products', ProductController::class)
    ->only(['index', 'store', 'create', 'update', 'destroy', 'productSearch'])
    ->middleware(['auth', 'verified']);
Route::get('/dashboard/products/search', SearchController::class)->middleware(['auth']);

Route::resource('/dashboard/stocks', \App\Http\Controllers\StockController::class)
    ->only(['index', 'store', 'create', 'update', 'destroy', ])
    ->middleware(['auth', 'verified']);
require __DIR__.'/auth.php';
