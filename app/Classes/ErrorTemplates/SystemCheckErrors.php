<?php

namespace App\Classes\ErrorTemplates;

class SystemCheckErrors
{
    /**
     * @param missingParam
     * @return json
    */
    public static function error_missing_env_params($missingParam)
    {
        $errorMessage['error_message'] = "Missing global environment parameters.";
        $errorMessage['error_data'] = ["missing_env_param" => $missingParam];

        response()->json($errorMessage, 503)->send();
    }
}
