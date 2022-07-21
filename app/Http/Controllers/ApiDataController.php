<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Classes
use App\Classes\DataServices\CareQualityData AS CareQualityDataService;

class ApiDataController extends Controller
{

    protected $isRemoteAPIStatus;

    public function __construct()
    {
        $this->isRemoteAPIStatus = CareQualityDataService::checkRemoteAPIStatus();
    }

    public function getRecords(Request $request)
    {
        if($request->has(['itemsPerPage', 'pageNumber']))
        {
           return CareQualityDataService::getRecordsPaginated($request->get('itemsPerPage'), $request->get('pageNumber'), $this->isRemoteAPIStatus);
        }

        return CareQualityDataService::getRecordsPaginated();
    }

    public function getRecord(Request $request)
    {
        if(!$request->get('providerId'))
        {
            return json_encode(["message" => "A Provider Id is required."]);
        }

        return CareQualityDataService::getRecordByProviderId($request->get('providerId'), $this->isRemoteAPIStatus); //1-101664105
    }
}
