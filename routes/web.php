<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Root Redirect to appropriate dashboard or customer catalog
Route::get('/', function () {
    if (auth()->check()) {
        $role = auth()->user()->role;
        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($role === 'supplier') {
            return redirect()->route('supplier.dashboard');
        }
    }
    return redirect()->route('user.dashboard');
})->name('home');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');

// Backward compatibility auth paths
Route::get('/auth/login', [AuthController::class, 'showLogin']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::get('/auth/register', [AuthController::class, 'showRegister']);
Route::post('/auth/register', [AuthController::class, 'register']);
Route::match(['get', 'post'], '/auth/logout', [AuthController::class, 'logout']);

// Public User / Customer Routes
Route::prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/collection', [UserController::class, 'collection'])->name('collection');
    Route::get('/detail/{id}', [UserController::class, 'detail'])->name('detail');

    // Cart and Checkout
    Route::post('/add_to_cart', [UserController::class, 'addToCart'])->name('add_to_cart');
    Route::match(['get', 'post'], '/cart', [UserController::class, 'cart'])->name('cart');
    Route::post('/sync_cart', [UserController::class, 'syncCart'])->name('sync_cart');

    Route::match(['get', 'post'], '/checkout', [UserController::class, 'checkout'])->name('checkout');
    Route::get('/checkout_done', [UserController::class, 'checkoutDone'])->name('checkout_done');

    // Customer Profile
    Route::middleware(['auth'])->group(function () {
        Route::get('/profile', [UserController::class, 'profile'])->name('profile');
        Route::post('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
    });
});

// Admin Protected Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Categories
    Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
    Route::post('/categories/store', [AdminController::class, 'storeCategory'])->name('categories.store');
    Route::post('/categories/update', [AdminController::class, 'updateCategory'])->name('categories.update');
    Route::post('/categories/delete', [AdminController::class, 'destroyCategory'])->name('categories.delete');

    // Products
    Route::get('/products', [AdminController::class, 'products'])->name('products');
    Route::post('/products/store', [AdminController::class, 'storeProduct'])->name('products.store');
    Route::post('/products/update', [AdminController::class, 'updateProduct'])->name('products.update');
    Route::post('/products/delete', [AdminController::class, 'destroyProduct'])->name('products.delete');

    // Stock Management & Requests
    Route::get('/stock', [AdminController::class, 'stock'])->name('stock');
    Route::get('/request_stock/{id}', [AdminController::class, 'showRequestStock'])->name('request_stock');
    Route::post('/request_stock/{id}', [AdminController::class, 'storeRequestStock'])->name('request_stock.store');

    // Users
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::post('/users/store', [AdminController::class, 'storeUser'])->name('users.store');
    Route::post('/users/update', [AdminController::class, 'updateUser'])->name('users.update');
    Route::post('/users/delete', [AdminController::class, 'destroyUser'])->name('users.delete');

    // Reports & Invoices
    Route::get('/sales_report', [AdminController::class, 'salesReport'])->name('sales_report');
    Route::get('/finance_report', [AdminController::class, 'financeReport'])->name('finance_report');
    Route::get('/invoices', [AdminController::class, 'invoices'])->name('invoices');
    Route::post('/invoices/pay', [AdminController::class, 'payInvoice'])->name('invoices.pay');

    // Profile
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::post('/profile', [AdminController::class, 'updateProfile'])->name('profile.update');
});

// Supplier Protected Routes
Route::prefix('supplier')->name('supplier.')->middleware(['auth', 'role:supplier'])->group(function () {
    Route::get('/dashboard', [SupplierController::class, 'dashboard'])->name('dashboard');
    Route::get('/stock_requests', [SupplierController::class, 'stockRequests'])->name('stock_requests');
    Route::post('/accept_request', [SupplierController::class, 'acceptRequest'])->name('accept_request');
    Route::get('/history', [SupplierController::class, 'history'])->name('history');
    Route::get('/profile', [SupplierController::class, 'profile'])->name('profile');
    Route::post('/profile', [SupplierController::class, 'updateProfile'])->name('profile.update');
});
