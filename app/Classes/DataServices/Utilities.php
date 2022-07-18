<?php

namespace App\Classes\DataServices;

// Models

// Framework

class Utilities
{

    // Get latest data from CQC data feed.
    public static function getLatestData()
    {

        // Limit the number of records shown for development reasons,
        // probably a good idea to page the results while processing due to the amount.
        // Hmm, is the providerID unique, if not that will be a problem.

        $perPage = 10;

        // Construct the URL here:
        $endPoint = "https://api.cqc.org.uk/public/v1/providers?perPage=" . $perPage;

        // Making use of a quick CURL request to get the data.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endPoint);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Not used at the moment.

        $output = curl_exec($ch);
        curl_close($ch);

        dd(json_decode($output));
    }

}
