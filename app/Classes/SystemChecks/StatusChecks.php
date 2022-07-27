<?php

namespace App\Classes\SystemChecks;

// Classes
use App\Classes\SystemChecks\Utilities AS SystemCheckUtilities;
use App\Classes\ErrorHandlers\SystemCheckErrors;

// Exceptions
use App\Classes\Exceptions\MissingEnvVariables;

class StatusChecks
{
    /*
    |--------------------------------------------------------------------------
    | A check to see if any defined .env vars are missing.
    |--------------------------------------------------------------------------
    */
    public function checkGlobalVarsExist()
    {
        try
        {
            SystemCheckUtilities::checkEnvVariableExists();
        }
        catch (MissingEnvVariables $missingEnvVariables)
        {
            SystemCheckErrors::error_missing_env_params($missingEnvVariables->getData());
        }
    }
}
