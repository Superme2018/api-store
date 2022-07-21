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

    public static function getRecord($providerID)
    {

        $query = CareQualityData::where('provider_id', $providerID);

        if(!$query->count())
        {
            return null;
        }

        return CareQualityData::where('provider_id', $providerID)->first()->toJson();
    }

    public static function getRecords($itemsPerPage, $pageNumber)
    {
        // Could wrap this into an array, that also contains extra data, such as total number of pages.
        return CareQualityData::paginate($itemsPerPage, ['*'], 'page', $pageNumber)->toJson();
    }

    public static function checkRemoteApiStatus()
    {

        $apiBaseEndpoint = 'https://api.cqc.org.uk/public/v1/providers';

        $ch = curl_init($apiBaseEndpoint);
        curl_setopt($ch, CURLOPT_HEADER, true);    // we want headers

        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_TIMEOUT,10);

        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $httpcode;
    }

}
