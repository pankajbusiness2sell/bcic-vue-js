<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\QuoteAPIController;

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



Route::get('/fetch-post-items', [QuoteAPIController::class, 'getPostCode']);
Route::get('/get-sites', [QuoteAPIController::class, 'getSiteslocation']);
Route::get('/quote-for', [QuoteAPIController::class, 'getQuoteFor']);
Route::get('/job-type', [QuoteAPIController::class, 'jobtypeids']);
Route::get('/job-type-info/{id?}', [QuoteAPIController::class, 'JobTypeInfo']);









