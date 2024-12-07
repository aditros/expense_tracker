<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExpenseCategoryController;
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

    Route::get('/expense-categories', [ExpenseCategoryController::class, 'index'])->name('expense-categories.index');
    Route::get('/expense-categories/create', [ExpenseCategoryController::class, 'createIndex'])->name('expense-categories.create.index');
    Route::post('/expense-categories/create', [ExpenseCategoryController::class, 'createPost'])->name('expense-categories.create.post');
    Route::get('/expense-categories/edit/{id}', [ExpenseCategoryController::class, 'editIndex'])->name('expense-categories.edit.index');
    Route::patch('/expense-categories/edit/{id}', [ExpenseCategoryController::class, 'editPatch'])->name('expense-categories.edit.patch');
    Route::delete('/expense-categories/delete/{id}', [ExpenseCategoryController::class, 'delete'])->name('expense-categories.delete');
});

require __DIR__.'/auth.php';
