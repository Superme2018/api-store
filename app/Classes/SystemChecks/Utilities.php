<?php

namespace App\Classes\SystemChecks;

// Classes
use App\Classes\Exceptions\MissingEnvVariables AS MissingEnvVariablesException;
use App\Classes\GlobalConfig\GlobalConfig;

class Utilities
{

    /**
     * @return bool
    */
    public static function checkEnvVariableExists():bool
    {

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
