<?php namespace App\Models\Repositories;

use Phalcon\Di\Injectable;
use App\Models\Repositories\Exceptions;

class Repositories extends Injectable {

    /**
     * Repository caller
     *
     * @param  string $name
     * @return \
     */
    public function uses($name)
    {
        $className = "\\App\\Models\\Repositories\\Repository\\{$name}";

        if ( ! class_exists($className)) {
            throw new Exceptions\InvalidRepositoryException("Repository {$className} doesn't exists.");
        }

        $repository = new $className();
        $repository->setDi($this->di);

        return $repository;
    }

}
