<?php

namespace App\Classes\SystemChecks;

// Classes
use App\Classes\Exceptions\MissingEnvVariables AS MissingEnvVariablesException;
use App\Classes\GlobalConfig\GlobalConfig;

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
        $envVarsToCheckFor = GlobalConfig::envVarsDefined();

        foreach($envVarsToCheckFor as $envVar)
        {
            if(env($envVar))
            {
                return true;
            }

            throw new MissingEnvVariablesException('Missing required ENV param: ' . $envVar, $envVar);
        }

    }

}
