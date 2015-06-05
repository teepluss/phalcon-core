<?php namespace App\Models\Repositories\Exceptions;

class ValidationException extends \Exception {

    protected $messages;

    public function __construct($messages)
    {
        $this->messages = $messages;
    }

    public function getErrors()
    {
        return $this->messages;
    }

}