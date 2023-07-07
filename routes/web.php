<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ShopController;
use App\Http\Controllers\Front\AccountController;
use App\Http\Controllers\Front\BlogController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckOutController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\Front\HistoryOrderController;

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

//Client

Route::get('/', [HomeController::class, 'index']);

Route::get('/contact', [ContactController::class, 'index']);


Route::prefix('shop')->group(function () {
    Route::get('product/{id}', [ShopController::class, 'show']);
    Route::post('product/{id}', [ShopController::class, 'postComment']);
    Route::get('', [ShopController::class, 'index']);
    Route::get('category/{categoryName}', [ShopController::class, 'category']);
});

Route::prefix('cart')->group(function () {
    Route::get('add', [CartController::class, 'add']);
    Route::get('/', [CartController::class, 'index']);
    Route::get('delete', [CartController::class, 'delete']);
    Route::get('destroy', [CartController::class, 'destroy']);
    Route::get('update', [CartController::class, 'update']);
});

Route::prefix('blog')->group(function () {
    Route::get('{id}', [BlogController::class, 'show']);
    Route::get('/', [BlogController::class, 'index']);
});

Route::prefix('checkout')->middleware('CheckMemberLogin')->group(function () {
    Route::get('', [CheckOutController::class, 'index']);
    Route::post('/', [CheckOutController::class, 'addOrder']);
    Route::get('/result', [CheckOutController::class, 'result']);
    Route::get('/vnPayCheck', [CheckOutController::class, 'vnPayCheck']);
});

Route::prefix('historyorder')->middleware('CheckMemberLogin')->group(function () {
    Route::get('', [HistoryOrderController::class, 'index']);
    Route::get('{id}', [HistoryOrderController::class, 'cancelOrder']);
});

Route::prefix('account')->group(function () {
    Route::get('login', [AccountController::class, 'login']);
    Route::post('login', [AccountController::class, 'checkLogin']);
    Route::get('logout', [AccountController::class, 'logout']);
    Route::get('register', [AccountController::class, 'register']);
    Route::post('register', [AccountController::class, 'postRegister']);
});


//Admin


Route::prefix('admin')->middleware('CheckAdminLogin')->group(function () {
    Route::redirect('', 'admin/user');
    Route::get('notification', [NotificationController::class, 'notification']);
    Route::resource('user', \App\Http\Controllers\Admin\UserController::class);
    Route::resource('category', \App\Http\Controllers\Admin\ProductCategoryController::class);
    Route::resource('brand', \App\Http\Controllers\Admin\BrandController::class);
    Route::resource('product/{product_id}/image', \App\Http\Controllers\Admin\ProductImageController::class);
    Route::resource('product/{product_id}/detail', \App\Http\Controllers\Admin\ProductDetailController::class);
    Route::resource('product', \App\Http\Controllers\Admin\ProductController::class);
    Route::get('order/print-order/{order_id}', [\App\Http\Controllers\Admin\OrderController::class, 'print_order']);

    Route::resource('order', \App\Http\Controllers\Admin\OrderController::class);
    Route::resource('customer', \App\Http\Controllers\Admin\CustomerController::class);

    Route::get('statistic', [StatisticController::class, 'index']);
    Route::post('statistic/filter-by-date', [StatisticController::class, 'filter_by_date']);
    Route::get('statistic/notification', [StatisticController::class, 'notification']);
    Route::post('statistic/dashboard-filter', [StatisticController::class, 'dashboard_filter']);
    Route::post('statistic/days-order', [StatisticController::class, 'days_order']);

    Route::prefix('login')->group(function () {
        Route::get('', [\App\Http\Controllers\Admin\HomeController::class, 'getLogin'])->withoutMiddleware('CheckAdminLogin');
        Route::post('', [\App\Http\Controllers\Admin\HomeController::class, 'postLogin'])->withoutMiddleware('CheckAdminLogin');
    });

    Route::get('logout', [\App\Http\Controllers\Admin\HomeController::class, 'logout']);
});
