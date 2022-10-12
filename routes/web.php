<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\HomeProductController;
use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\DiscountController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\User\OrderHistoryController;
use App\Http\Controllers\User\OrderManagementController;
use App\Http\Controllers\User\UserController as UserProfileController;
use App\Http\Controllers\User\StatisticController as UserStatisticController;
use App\Http\Controllers\Admin\StatisticController as AdminStatisticController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('brands', BrandController::class);
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
    });
    Route::resource('statistic', AdminStatisticController::class)->only('index');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/login', [LoginController::class, 'postLogin'])->name('login.post');
Route::resource('register', RegisterController::class)->only(['create', 'store']);

Route::name('home.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/category/{id}', [HomeController::class, 'showProductsByCategory'])->name('category');
    Route::get('/brand/{id}', [HomeController::class, 'showProductsByBrand'])->name('brand');
});

Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', [HomeProductController::class, 'index'])->name('index');
    Route::get('/{id}', [HomeProductController::class, 'show'])->name('show');
    Route::middleware('user')->get('/{id}/rate', [HomeProductController::class, 'rate'])->name('rate');
    Route::middleware('user')->prefix('/comments')->name('comments.')->group(function () {
        Route::post('/', [CommentController::class, 'store'])->name('store');
        Route::patch('/{id}', [CommentController::class, 'update'])->name('update');
        Route::delete('/{id}', [CommentController::class, 'destroy'])->name('destroy');
    });
});

Route::middleware('user')->prefix('/user')->name('user.')->group(function () {
    Route::get('/profile/edit', [UserProfileController::class, 'edit'])->name('edit');
    Route::put('/profile', [UserProfileController::class, 'update'])->name('update');
    Route::get('/statistic', [UserStatisticController::class, 'index'])->name('statistic');
    Route::prefix('/products')->name('products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [ProductController::class, 'update'])->name('update');
        Route::delete('/{id}/delete', [ProductController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('/discounts')->name('discounts.')->group(function () {
        Route::get('/', [DiscountController::class, 'index'])->name('index');
        Route::get('/create', [DiscountController::class, 'create'])->name('create');
        Route::post('/', [DiscountController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [DiscountController::class, 'edit'])->name('edit');
        Route::put('/{id}/edit', [DiscountController::class, 'update'])->name('update');
        Route::delete('/{id}/delete', [DiscountController::class,  'destroyDiscount'])->name('destroyDiscount');
        Route::get('/{id}/viewDiscount', [DiscountController::class, 'show'])->name('show');
        Route::get('/{id}/viewDiscount/sendEmail', [DiscountController::class, 'sendCouponViaEmail'])->name('sendCouponViaEmail');
        Route::get('/{id}/viewDiscount/create', [DiscountController::class, 'createNewCode'])->name('createNewCode');
        Route::post('/{id}/viewDiscount', [DiscountController::class, 'storeNewCode'])->name('storeNewCode');
        Route::delete('/{id}/viewDiscount/{discountProductId}/delete', [DiscountController::class, 'destroyDiscountProduct'])->name('destroyDiscountProduct');
    });
    Route::prefix('/orders')->name('orders.')->group(function () {
        Route::get('/', [OrderHistoryController::class, 'index'])->name('index');
        Route::get('/{id}', [OrderHistoryController::class, 'show'])->name('show');
        Route::patch('/{id}', [OrderHistoryController::class, 'update'])->name('update');
    });
    Route::prefix('/orders-management')->name('orders-management.')->group(function () {
        Route::get('/', [OrderManagementController::class, 'index'])->name('index');
        Route::patch('/{id}', [OrderManagementController::class, 'destroy'])->name('destroy');
        Route::patch('/orders/{id}/{status}', [OrderManagementController::class, 'update'])->name('update');
        Route::get('/{id}', [OrderManagementController::class, 'show'])->name('show');
    });
});

Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
Route::post('/update/cart', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/coupon', [CartController::class, 'applyCoupon'])->name('cart.coupon');
Route::middleware('user')->get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

//Login with Social account
Route::prefix('login')->group(function () {
    //Login with Google Account
    Route::name('google.')->group(function () {
        Route::get('/google', [LoginController::class, 'redirectToSocial'])->name('login');
        Route::get('/google/callback', [LoginController::class, 'handleSocialCallback'])->name('callback');
    });
    //Login with Github Account
    // Route::name('github.')->group(function () {
    //     Route::get('/github', [LoginController::class, 'redirectToSocial'])->name('login');
    //     Route::get('/github/callback', [LoginController::class, 'handleSocialCallback'])->name('callback');
    // });
    //Login with Facebook Account
    Route::name('facebook.')->group(function () {
        Route::get('/facebook', [LoginController::class, 'redirectToSocial'])->name('login');
        Route::get('/facebook/callback', [LoginController::class, 'handleSocialCallback'])->name('callback');
    });
});
