<?php

namespace App\Classes\SystemChecks;

// Classes
use App\Classes\Exceptions\MissingEnvVariables AS MissingEnvVariablesException;
use App\Classes\GlobalConfig\GlobalConfig;

class StatusChecks
{

    /**
     * @return bool
    */
    public static function checkEnvVariablesExist():bool
    {

        $envVarsToCheckFor = GlobalConfig::envVarsDefined();

        foreach($envVarsToCheckFor as $envVar)
        {
            if(env($envVar))
            {
                continue;
            }

            throw new MissingEnvVariablesException('Missing required ENV param: ' . $envVar, $envVar);
        }

        return true;

    }

}
