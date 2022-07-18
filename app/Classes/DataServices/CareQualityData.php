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
        dd(
            "Is this wokring:" . __FUNCTION__,
            CareQualityDataUtilities::getLatestData()
        );
    }

}
