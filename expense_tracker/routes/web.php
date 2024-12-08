<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\ExpenseItemController;
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
    
    Route::get('/expense-items', [ExpenseItemController::class, 'index'])->name('expense-items.index');
    Route::get('/expense-items/create', [ExpenseItemController::class, 'createIndex'])->name('expense-items.create.index');
    Route::post('/expense-items/create', [ExpenseItemController::class, 'createPost'])->name('expense-items.create.post');
    Route::get('/expense-items/edit/{id}', [ExpenseItemController::class, 'editIndex'])->name('expense-items.edit.index');
    Route::patch('/expense-items/edit/{id}', [ExpenseItemController::class, 'editPatch'])->name('expense-items.edit.patch');
    Route::delete('/expense-items/delete/{id}', [ExpenseItemController::class, 'delete'])->name('expense-items.delete');
});

require __DIR__.'/auth.php';
