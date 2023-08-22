<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassportController;
use App\Http\Controllers\PackageController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('register', [PassportController::class, 'register']);
Route::post('login', [PassportController::class, 'login']);
Route::get('showadmin', [PassportController::class, 'showall']);
Route::post('updateadmin/{id}', [PassportController::class, 'update_admin']);


///Pricing Routes///////
Route::get('allpricing', [PackageController::class, 'allPricing']);
Route::post('addpricing', [PackageController::class, 'addPricing']);
Route::post('updatepricing/{id}', [PackageController::class, 'update_pricing']);
Route::post('deletepricing/{id}', [PackageController::class, 'destroy_pricing']);
Route::get('singlepricing/{id}', [PackageController::class, 'show_single_pricing']);
Route::get('allpricingcut/{id}', [RefererController::class, 'allPricing_after_Cuting']);



Route::get('clients/showclients', [PassportController::class, 'showallclients']);
Route::get('clients/singleclients/{id}', [PassportController::class, 'show']);







Route::middleware('auth:api')->group(function () {
    Route::post('user-detail', [PassportController::class, 'userDetail']);
    Route::post('logout', [PassportController::class, 'logout']);
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
