<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MethodController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OriginController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//USER ENDPOINTS
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/me', [AuthController::class, 'me'])->middleware('jwt.auth');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('jwt.auth');

//ADMIN ENDPOINTS
Route::group(["middleware" => ["jwt.auth"]], function() {
    Route::post('/user/super_admin/{id}', [UserController::class, 'addSuperAdminRole']);
    Route::post('/user/super_admin_delete/{id}', [UserController::class, 'deleteSuperAdminRole']);
    Route::post('/user/add_admin/{id}', [UserController::class, 'addAdminRole']);
    Route::post('/user/delete_admin/{id}', [UserController::class, 'deleteAdminRole']);
});

//ADDRESS ENDPOINTS
Route::group(["middleware" => ["jwt.auth"]], function() {
    Route::post('/user/address/add', [AddressController::class, 'addAddress']);
    // Route::post('/user/super_admin_delete/{id}', [UserController::class, 'deleteSuperAdminRole']);
    // Route::post('/user/add_admin/{id}', [UserController::class, 'addAdminRole']);
    // Route::post('/user/delete_admin/{id}', [UserController::class, 'deleteAdminRole']);
});

//Payments Methods ENDPOINTS
Route::group(["middleware" => ["jwt.auth"]], function() {
    Route::post('/user/payment/add', [MethodController::class, 'addPaymentMethod']);
    // Route::post('/user/super_admin_delete/{id}', [UserController::class, 'deleteSuperAdminRole']);
    // Route::post('/user/add_admin/{id}', [UserController::class, 'addAdminRole']);
    // Route::post('/user/delete_admin/{id}', [UserController::class, 'deleteAdminRole']);
});

//ORIGIN ENDPOINTS
Route::group(["middleware" => ["jwt.auth" , "isSuperAdmin"]], function() {
    Route::post('/origin/create', [OriginController::class, 'createOrigin']);
    // Route::post('/user/super_admin_delete/{id}', [UserController::class, 'deleteSuperAdminRole']);
    // Route::post('/user/add_admin/{id}', [UserController::class, 'addAdminRole']);
    // Route::post('/user/delete_admin/{id}', [UserController::class, 'deleteAdminRole']);
});

//PRODUCT ENDPOINTS
Route::group(["middleware" => ["jwt.auth" , "isSuperAdmin"]], function() {
    Route::post('/product/add', [ProductController::class, 'addProduct']);
    // Route::post('/user/super_admin_delete/{id}', [UserController::class, 'deleteSuperAdminRole']);
    // Route::post('/user/add_admin/{id}', [UserController::class, 'addAdminRole']);
    // Route::post('/user/delete_admin/{id}', [UserController::class, 'deleteAdminRole']);
});

//PRODUCT ENDPOINTS
Route::group(["middleware" => ["jwt.auth"]], function() {
    Route::post('/order/create', [OrderController::class, 'createOrder']);
    Route::post('/order/add', [OrderController::class, 'addProductToOrder']);
    // Route::post('/user/add_admin/{id}', [UserController::class, 'addAdminRole']);
    // Route::post('/user/delete_admin/{id}', [UserController::class, 'deleteAdminRole']);
});
