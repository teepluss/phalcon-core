<?php namespace App\Config\Routes\Frontend;

use Phalcon\Mvc\Router\Group as RouterGroup;

class Blog extends RouterGroup {

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

        $this->setPrefix('/blogs');

        $this->add('/', array(
            'controller' => 'blogs',
            'action'     => 'index',
        ));
    }

}