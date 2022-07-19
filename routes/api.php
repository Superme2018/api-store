<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Classes
use App\Classes\DataServices\CareQualityData AS CareQualityDataService;

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

Route::get('/records', function(Request $request) {

    dd($request);

    CareQualityDataService::getRecordsPaginated(15, 10);

});

Route::get('/records', function(Request $request) {

    dd($request);

    CareQualityDataService::getRecordByProviderId('1-101664105');
});
