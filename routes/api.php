<?php

use App\Http\Controllers\Api\ProductController;
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

// My Very First API Route in Laravel 9
Route::apiResource('products', ProductController::class);

Route::get('products/search/{name}', [ProductController::class, 'search']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
