<?php

namespace App\Classes\Exceptions;

// Framework
use Exception;

class MissingEnvVariables extends Exception
{

    protected $data;
    protected $message;

    public function __construct($message, $data)
    {
        $this->message = $message;
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        // Is the request needed?

        return response()->view('errors.system-config', [
            "message" => $this->message,
            "data" => $this->data
        ], 500);
    }
}
