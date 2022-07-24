<?php

namespace App\Classes\Exceptions;

// Framework
use Exception;

/**
 * Define a custom exception class
 */
class MissingEnvVariables extends Exception
{
    public function __construct($message, $data)
    {
        $this->_data = $data;
        parent::__construct($message);
    }

    public function getData()
    {
        return $this->_data;
    }
}
