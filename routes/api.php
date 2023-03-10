<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AccountGatewayController;
use App\Http\Controllers\AccountUserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\TokenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('account', AccountController::class)->middleware('auth:sanctum');
Route::apiResource('account-gateway', AccountGatewayController::class)->middleware('auth:sanctum');
Route::apiResource('account-user', AccountUserController::class)->middleware('auth:sanctum');
Route::apiResource('customer', CustomerController::class)->middleware('auth:sanctum');
Route::apiResource('payment-method', PaymentMethodController::class)->middleware('auth:sanctum');

Route::post('/tokens', [TokenController::class, 'store']);
Route::delete('/tokens', [TokenController::class, 'destroy']);
