<?php

namespace App\Classes\DataServices;

// Class
use App\Classes\DataServices\Utilities AS CareQualityDataUtilities;

// Models

// Framework

class CareQualityData
{

    // Just incase needed
    public static function dataSync()
    {

        if(!$apiLimits = CareQualityDataUtilities::getApiLimits())
        {
            dd("Just a quick check to make sure we have data. Even though null has not been handled yet.");
        }

        dd(CareQualityDataUtilities::getLatestData($apiLimits));


    }

}
