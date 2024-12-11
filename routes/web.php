<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
});

Route::group(['middleware' => 'auth'], function(){
    Route::get('/books', [BookController::class, 'index']) -> name('book');
    Route::get('/books/create', [BookController::class, 'create']) -> name('book.create');
    Route::post('/books', [BookController::class, 'store']) -> name('book.store');
    Route::get('/books/{id}/edit', [BookController::class, 'edit']) -> name('book.edit');
    Route::patch('/books/{id}', [BookController::class, 'update']) -> name('book.update');
    Route::delete('/books/{id}', [BookController::class, 'destroy']) -> name('book.destroy');
    Route::get('/books/print', [BookController::class, 'print']) -> name('book.print');
    Route::get('/books/export', [BookController::class, 'export']) -> name('book.export');

});

require __DIR__.'/auth.php';
