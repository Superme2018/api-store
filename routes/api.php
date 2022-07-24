<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\ApiDataController;
use App\Http\Controllers\ApiErrorController;

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

Route::get('/records', [ApiDataController::class, 'getRecords']);
Route::get('/record', [ApiDataController::class, 'getRecord']);

/**
 * Error handler routs.
 *
 */

Route::get('/error/global/missing-env-params', [ApiErrorController::class, 'missing_env_params'])->name('missing_env_params');
