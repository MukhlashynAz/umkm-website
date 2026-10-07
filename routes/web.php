<?php

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\CompanyProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Models\CompanyProfile;
use Illuminate\Support\Facades\Route;


// =========================
// PUBLIC WEBSITE
// =========================

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/products/{slug}', [ProductController::class, 'show'])
    ->name('products.show');

Route::get('/categories', [CategoryController::class, 'index'])
    ->name('categories.index');

Route::get('/categories/{slug}/products', [CategoryProductController::class, 'index'])
    ->name('categories.products');

Route::get('/about', function () {
    $company = CompanyProfile::first();

    return view('about', compact('company'));
})->name('about');


// =========================
// ADMIN
// =========================

Route::prefix('admin')
    ->name('admin.')
    ->middleware('admin')
    ->group(function () {

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Categories
        Route::resource('categories', AdminCategoryController::class);

        // Products
        Route::resource('products', AdminProductController::class);

        // Company Profile
        Route::get('/company-profile', [CompanyProfileController::class, 'edit'])
            ->name('company-profile.edit');

        Route::put('/company-profile', [CompanyProfileController::class, 'update'])
            ->name('company-profile.update');
    });


// =========================
// AUTH
// =========================

require __DIR__.'/auth.php';