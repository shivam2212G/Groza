<?php

use App\Http\Controllers\AdminCotroller;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubcategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/register',[AdminCotroller::class,'showReisterForm'])->name('showReisterForm');
Route::post('/register',[AdminCotroller::class,'store'])->name('admin.store');
Route::get('/', [AdminCotroller::class, 'showLoginForm'])->name('admins.login');
Route::post('/admin/login', [AdminCotroller::class, 'login'])->name('admins.login.submit');


Route::middleware('admin.auth')->group(function () {
    Route::get('/admin/dashboard', [AdminCotroller::class, 'dashboard'])->name('admins.dashboard');
    Route::post('/admin/logout', [AdminCotroller::class, 'logout'])->name('admins.logout');
    Route::get('/admin/profile/{id}',[AdminCotroller::class,'profile'])->name('admin.profile');
    Route::put('/admin/status/{id}', [AdminCotroller::class, 'updateStatus'])->name('admin.updateStatus');
    Route::get('/admin/profile/{id}/edit', [AdminCotroller::class, 'editProfile'])->name('admin.profile.edit');
    Route::put('/admin/profile/{id}/update', [AdminCotroller::class, 'updateProfile'])->name('admin.profile.update');

    Route::get('/admin/category', [CategoryController::class, 'showcategory'])->name('admin.category');
    Route::get('addcategory', [CategoryController::class, 'showcatform'])->name('categories.create');
    Route::post('addcategory', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('editcategory/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('updatecategory/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::get('deletecategory/{id}', [CategoryController::class, 'delete'])->name('categories.delete');

    Route::get('subcategories', [SubcategoryController::class, 'index'])->name('subcategories.index');
    Route::get('subcategories/create', [SubcategoryController::class, 'create'])->name('subcategories.create');
    Route::post('subcategories', [SubcategoryController::class, 'store'])->name('subcategories.store');
    Route::get('subcategories/edit/{id}', [SubcategoryController::class, 'edit'])->name('subcategories.edit');
    Route::post('subcategories/update/{id}', [SubcategoryController::class, 'update'])->name('subcategories.update');
    Route::get('subcategories/delete/{id}', [SubcategoryController::class, 'delete'])->name('subcategories.delete');

    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::post('products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('products/update/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::get('products/delete/{id}', [ProductController::class, 'delete'])->name('products.delete');
    Route::get('products/create', [ProductController::class, 'create'])->name('products.create');


});
