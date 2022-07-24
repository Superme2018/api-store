<?php

namespace App\Classes\SystemChecks;

// Not used yet.
use App\Classes\Exceptions\MissingEnvVariables AS MissingEnvVariablesException;

// Framework
use Exception;

class Utilities
{

    /**
     * @return bool
    */
    public static function checkEnvVariableExists():bool
    {

        // Maybe to also move this out to a configuration class.
        $envVarsToCheckFor = self::config_envVarsToCheckFor();

        foreach($envVarsToCheckFor as $envVar)
        {
            if(env($envVar))
            {
                return true;
            }

            throw new Exception('Missing required ENV params.');
        }

    }

    // Move this over to a new class, with a cascading error creation.

    /**
     * @return json
    */
    public static function error_missing_env_params():string
    {
        $errorMessage['error_message'] = "Missing global environment parameters";
        $errorMessage['error_supporting_data'] = ["env_params" => self::config_envVarsToCheckFor()];

        return json_encode($errorMessage);
    }

    /**
     * @return array
    */
    private static function config_envVarsToCheckFor()
    {
        return ['API_URL_ENDPOINT'];
    }
}
