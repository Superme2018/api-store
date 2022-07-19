<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Classes
use App\Classes\DataServices\CareQualityData AS CareQualityDataService;


class ApiDataController extends Controller
{
    public function getRecords(Request $request)
    {
        dd($request);

        CareQualityDataService::getRecordsPaginated(15, 10);
    }

    public function getRecord(Request $request)
    {
        dd($request);

        CareQualityDataService::getRecordByProviderId('1-101664105');
    }
}
