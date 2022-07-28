<?php

namespace App\Classes\GlobalConfig;

class GlobalConfig
{
    /**
     * Returns an array containing all the defined environment variables.
     *
     * @return array
     */
    public static function envVarsDefined()
    {
        return ['APP_ENV', 'API_URL_ENDPOINT'];
    }

}
