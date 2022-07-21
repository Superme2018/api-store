<?php

namespace App\Classes\DataServices;

// Class
use App\Classes\DataServices\Utilities AS CareQualityDataUtilities;

class CareQualityData
{

    public static function checkRemoteAPIStatus()
    {
        if(CareQualityDataUtilities::checkRemoteApiStatus() != 200)
        {
            return true;
        }

        return false;

    }

    public static function getApiLimits()
    {
        // A little odd but has to be set just incase the API default was to change.
        $perPage = 1000;

        // Default API requist just to get hold of the total number of pages.
        $endPoint = "https://api.cqc.org.uk/public/v1/providers?perPage=" . $perPage;

        // Making use of a quick CURL request to get the data.
        $result = CareQualityDataUtilities::curlRequest($endPoint);

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

    public static function syncLatestData($apiLimits, $apiStatus)
    {

        if(!$apiStatus)
        {
            dd("Remote API is down.");
        }

        if(!count($apiLimits)) // <- Note this will fail if not an array. Need to check that it is an array first.
        {
            dd(" apiLimits are required.");
        }

        // Iterate over a selection of the number of pages found.
        for ($pageCount = 1; $pageCount <= $apiLimits['totalPages']; $pageCount ++)
        {
            // Construct the end point using the page offset.
            $endPoint = "https://api.cqc.org.uk/public/v1/providers?page=" . $pageCount . "&perPage=" . $apiLimits['perPage'];
            $results = CareQualityDataUtilities::curlRequest($endPoint);

            // May want to check that "providers" exists here.

            // Process the result per page, store data to the database.
            foreach($results->providers as $result)
            {
                if(!CareQualityDataUtilities::storeCareQualityRecord($result))
                {
                    dd("Creation of care quality record failed:", $result); // Come back to this later.
                }
            }

            // Stop after 4 pages have been reached.
            if($pageCount > 4)
            {
                dd("End of insert test.");
            }

            // Small delay to avoid overloading the API.
            sleep(1);

        }

    }

    public static function getRecordsPaginated($apiStatus, $itemsPerPage = null, $pageNumber = null, )
    {

         // Hmm, bit of replication going on here, but a good place to set defaults.
        if(!$itemsPerPage)
        {
            $itemsPerPage = 15;
        }

        if(!$pageNumber)
        {
            $pageNumber = 1;
        }

        return CareQualityDataUtilities::getRecords($itemsPerPage, $pageNumber);
    }

    public static function getRecordByProviderId($providerID = null, $apiStatus)
    {

        if(!$providerID)
        {
            dd("Provider ID is required!");
        }

        return CareQualityDataUtilities::getRecord($providerID);
    }

}
