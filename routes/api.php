<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v1\PropertyController;
use App\Http\Controllers\v1\WishlistController;

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

// Per spec, auth is not required at this point
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('v1/properties', [PropertyController::class, 'getProperties']);

Route::get('v1/wishlist-properties', [WishlistController::class, 'getWishlist']);
Route::post('v1/wishlist-properties', [WishlistController::class, 'addToWishlist']);
Route::delete('v1/wishlist-properties', [WishlistController::class, 'removeFromWishlist']);
