<?php

namespace App\Classes\Exceptions;

// Framework
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Define a custom exception class
 */
abstract class MissingEnvVariables extends Exception
{
    public function render(Request $request): Response
    {
        $status = 400;
        $error = "Something is wrong";
        $help = "Contact the sales team to verify";

        return response(["error" => $error, "help" => $help], $status);
    }
}
