<?php

namespace App\Classes\SystemChecks;

// Classes
use App\Classes\SystemChecks\Utilities AS SystemCheckUtilities;
use App\Classes\ErrorHandlers\SystemCheckErrors;

// Exceptions
use App\Classes\Exceptions\MissingEnvVariables;

class StatusChecks
{

    public function __construct()
    {
        // Check that we have the required variables in the
        try
        {
            SystemCheckUtilities::checkEnvVariableExists();
        }
        catch (MissingEnvVariables $missingEnvVariables)
        {
            SystemCheckErrors::error_missing_env_params($missingEnvVariables->getData());
        }

    }

    public function checkRemoteApiStatus():int
    {

        $apiBaseEndpoint = env('API_URL_ENDPOINT');

        $ch = curl_init($apiBaseEndpoint);
        curl_setopt($ch, CURLOPT_HEADER, true);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_TIMEOUT,10);

        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $httpcode;
    }
}
