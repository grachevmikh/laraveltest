<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\MainController::class, 'index'])->name('main');
Route::get('/something/create', [\App\Http\Controllers\MainController::class, 'create'])->name('something.create');
Route::post('/something/store', [\App\Http\Controllers\MainController::class, 'store'])->name('something.store');
Route::get('/something/edit/{id}', [\App\Http\Controllers\MainController::class, 'edit'])->name('something.edit');
Route::patch('/something/update/{id}', [\App\Http\Controllers\MainController::class, 'update'])->name('something.update');


Route::get('/category/create', [\App\Http\Controllers\CategoriesController::class, 'create'])->name('category.create');
Route::post('/category/store', [\App\Http\Controllers\CategoriesController::class, 'store'])->name('category.store');
Route::get('/category/edit/{id}', [\App\Http\Controllers\CategoriesController::class, 'edit'])->name('category.edit');
Route::patch('/category/update/{id}', [\App\Http\Controllers\CategoriesController::class, 'update'])->name('category.update');
Route::delete('/category/destroy/{id}', [\App\Http\Controllers\CategoriesController::class, 'destroy'])->name('category.destroy');


Route::get('/subCategory/create', [\App\Http\Controllers\SubCategoriesController::class, 'create'])->name('subCategory.create');
Route::post('/subCategory/store', [\App\Http\Controllers\SubCategoriesController::class, 'store'])->name('subCategory.store');
Route::get('/subCategory/edit/{id}', [\App\Http\Controllers\SubCategoriesController::class, 'edit'])->name('subCategory.edit');
Route::patch('/subCategory/update/{id}', [\App\Http\Controllers\SubCategoriesController::class, 'update'])->name('subCategory.update');
Route::delete('/subCategory/destroy/{id}', [\App\Http\Controllers\SubCategoriesController::class, 'destroy'])->name('subCategory.destroy');


