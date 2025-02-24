<?php


use App\Http\Controllers\PreProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ManReportController;
use App\Http\Controllers\UserReportController;
use App\Http\Controllers\DeliveryManController;
use App\Http\Controllers\DeliveryAreaController;
use App\Http\Controllers\CustomerOpinionController;
use App\Http\Controllers\OrderDeliveryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {
    Route::post('upload', [FilesController::class, 'store'])->name('upload');
    Route::GET('colorChange/{id}', [ProductController::class, 'editColor'])->name('changeColor');
    Route::POST('colorStore/{id}', [ColorController::class, 'colorStore'])->name('colorStore');
    Route::resource('colors', ColorController::class);
    Route::resource('admins', AdminsController::class);
    Route::resource('cities', CityController::class);
    Route::resource('areas', DeliveryAreaController::class);
    Route::resource('sections', SectionController::class);
    Route::resource('banks', BankController::class);
    Route::resource('products', ProductController::class);
    Route::resource('coupons', CouponController::class);
    Route::resource('opinions', CustomerOpinionController::class);
    Route::resource('Preproducts', PreProduct::class);
    Route::resource('credits', DeliveryManController::class);
    Route::resource('UserReports', UserReportController::class);
    Route::resource('ManReports', ManReportController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('users', UsersController::class);
    Route::resource('orderDelivery', OrderDeliveryController::class);
    Route::get('/home', [HomeController::class, 'index'])->name('home');



    Route::GET('logout', function () {
        Auth::logout();
        return back();
    })->name('logout');
});
