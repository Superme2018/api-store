<?php

namespace App\Classes\SystemChecks;

// Class
use App\Classes\SystemChecks\Utilities AS SystemCheckUtilities;

// Framework
use Exception;

class StatusChecks
{

    public function __construct()
    {
        // Check that we have the required variables in the
        // .env, before proceeding with this class.

        try
        {
            SystemCheckUtilities::checkEnvVariableExists();
        }
        catch (Exception $e)
        {
            // Hmm, exception not getting caught as expected.
            return SystemCheckUtilities::error_missing_env_params();
        }

    }

    public function checkRemoteApiStatus():int
    {

        $apiBaseEndpoint = env('API_URL_ENDPOINT');

        $ch = curl_init($apiBaseEndpoint);
        curl_setopt($ch, CURLOPT_HEADER, true);    // we want headers

        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_TIMEOUT,10);

        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $httpcode;
    }
}
