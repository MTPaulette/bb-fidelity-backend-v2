<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/* unauthenticated route */
Route::post("/login",[UserAccountController::class, "login"])->name("login");
Route::post("/register",[UserAccountController::class, "register"])->name("register");


/* authenticated route: both user and admin */

// Route::middleware(['auth:sanctum', 'abilities:view-historic,view-profile'])->group(function () {
Route::middleware('auth:sanctum')->group(function () {
    Route::delete("/logout",[UserAccountController::class, "logout"])->name("logout");
    Route::put('/profile', [UserAccountController::class, 'update'])->name('profile.update');
    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');
    // Route::post("/reset",[PasswordController::class, "store"])->name("reset");
    Route::get('/user/{user_id}/services', [PurchaseController::class, 'allServicesOfUser'])->name('user.services.show');
});


/* only admin route */
Route::middleware(['auth:sanctum', 'abilities:admin'])->group(function () {

    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/user/{id}', [UserController::class, 'show'])->name('user');
    Route::get('/recent/user', [UserController::class, 'recent'])->name('user.recent');
    
    /* service's route */
    Route::get('/services', [ServiceController::class, 'index'])->name('services');
    Route::get('/service/{id}', [ServiceController::class, 'show'])->name('service.show');
    Route::get('/recent/service', [ServiceController::class, 'recent'])->name('service.recent');
    Route::post("/service/store",[ServiceController::class, "store"])->name("service.store");
    Route::put('/service/{id}/update', [ServiceController::class, 'update'])->name('service.update');
    
    /* purchase's routes */
    Route::get('/purchases', [PurchaseController::class, 'index'])->name('purchases');
    Route::get('/purchase/{id}', [PurchaseController::class, 'show'])->name('purchase.show');
    Route::post("/purchase/store",[PurchaseController::class, "store"])->name("purchase.store");
    
    Route::get('/service/{service_id}/users', [PurchaseController::class, 'allUsersOfService'])->name('service.users.show');
    
});

// http://127.0.0.1:8000/api/register?email=mayogue@test.com&name=mayogue&password=123456789&confirm_password=123456789

// http://127.0.0.1:8000/api/service/1/users

// http://127.0.0.1:8000/api/user/10/services

// http://127.0.0.1:8000/api/purchase/2?user_id=3

// http://127.0.0.1:8000/api/purchase/store?user_id=10&service_id=4&admin_id=12&by_cash=true

// http://127.0.0.1:8000/api/service/store?name=showroom 9 months&price=25000&point=70t&validity=1 month&description=1 moisau showroom&user_id=12