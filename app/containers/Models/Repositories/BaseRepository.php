<?php namespace App\Models\Repositories;

use Phalcon\Di\Injectable;
use App\Models\Repositories\Exceptions\ValidationException;

abstract class BaseRepository extends Injectable {

    protected $model;

    public function __construct()
    {
        $model = "App\Models\Entities\\".$this->getModel();

        $this->model = new $model;
    }

    public function __call($method, $arguments = [])
    {
        if ( ! method_exists($this, $method))
        {
            return call_user_func_array([$this->model, $method], $arguments);
        }
    }

    protected function fails($model)
    {
        $messages = $model->getMessages();

        return new ValidationException($messages);
    }

}

