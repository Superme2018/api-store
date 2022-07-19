<?php

namespace App\Classes\DataServices;

// Models
use App\Models\CareQualityData;

// Framework

class Utilities
{

    // The curl request code. Could review this for testing.
    public static function curlRequest($endPoint)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endPoint);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Not used at the moment.

        $output = curl_exec($ch);
        curl_close($ch);

        return json_decode($output);
    }

    // Check or create record.
    public static function storeCareQualityRecord($data)
    {
        if(!$careQualityData = CareQualityData::where('provider_id', $data->providerId)->first())
        {
            $careQualityData = new CareQualityData();
            $careQualityData->provider_id = $data->providerId;
            $careQualityData->provider_name = $data->providerName;
        }

        if($careQualityData->save())
        {
            return true;
        }

        return false;
    }

}
