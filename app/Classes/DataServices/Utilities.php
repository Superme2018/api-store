<?php

namespace App\Classes\DataServices;

// Models

// Framework

class Utilities
{

    public static function getApiLimits()
    {
        // A little odd but has to be set just incase the API default was to change.
        $perPage = 1000;

        // Default API requist just to get hold of the total number of pages.
        $endPoint = "https://api.cqc.org.uk/public/v1/providers?perPage=" . $perPage;

        // Making use of a quick CURL request to get the data.
        $result = self::curlRequest($endPoint);

        if(!isset($result->totalPages))
        {
            dd("Total number of pages not found, Need an error handler here."); // Come back to this later.
        }

        if(!isset($result->perPage))
        {
            dd("Number of records per page not found, Need an error handler here."); // Come back to this later.
        }

        // Set the params.
        $params['totalPages'] = $result->totalPages;
        $params['perPage'] = $result->perPage;

        return $params;

    }

    // Get latest data from CQC data feed.
    public static function getLatestData($apiLimits)
    {
        // Iterate of a selection of the number of pages found.
        for ($x = 1; $x <= $apiLimits['totalPages']; $x ++)
        {
            // Construct the end point using the page offset.
            $endPoint = "https://api.cqc.org.uk/public/v1/providers?page=" . $x . "&perPage=" . $apiLimits['perPage'];
            $result = self::curlRequest($endPoint);

            // Stop after 1 has been reached.
            if($x > 1)
            {
                dd($x, $result);
            }

        }

        // Seems a bit odd but will also store check and store the data here.
        // I guess a log of any issues encountered can be passed back to the calling class.

        dd($result);
    }

    private static function curlRequest($endPoint)
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

}
