<?php

use     Illuminate\Http\Request;
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

use \App\Http\Controllers\Api\TenantApiController;
use \App\Http\Controllers\Api\CategoryApiController;
use \App\Http\Controllers\Api\TableApiController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Tenants
 */

Route::get('/tenants/{uuid}', [TenantApiController::class, 'show']);
Route::get('/tenants', [TenantApiController::class, 'index']);

/**
 * Categories
 */
Route::get('/categories/{url}', [CategoryApiController::class, 'show']);
Route::get('/categories', [CategoryApiController::class, 'getCategoriesByTenant']);


/**
 * Tables
 */
Route::get('/tables/{url}', [TableApiController::class, 'show']);
Route::get('/tables', [TableApiController::class, 'getTablesByTenant']);
