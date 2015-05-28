<?php namespace App\Config\Routes\Frontend;

use Phalcon\Mvc\Router\Group as RouterGroup;

class Home extends RouterGroup {

    /**
     * Setting routes.
     *
     * @return void
     */
    public function initialize()
    {
        $this->setPaths([
            'module' => 'frontend'
        ]);

        $this->setPrefix('/');

        $this->add('/', array(
            'controller' => 'index',
            'action'     => 'index',
        ));
    }

}