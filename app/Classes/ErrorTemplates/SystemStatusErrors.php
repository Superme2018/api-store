<?php

namespace App\Classes\ErrorTemplates;

class SystemStatusErrors
{
    /**
     * @param missingParam
     * @return mixed
    */
    public static function error_missing_env_params($missingParam)
    {
        $errorMessage['error_message'] = "Missing global environment parameters.";
        $errorMessage['error_data'] = ["missing_env_param" => $missingParam];
    }
}
