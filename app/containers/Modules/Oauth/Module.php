<?php namespace App\Modules\Oauth;

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\DiInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Events\Manager as EventsManager;

class Module implements ModuleDefinitionInterface {

    /**
     * Register a specific autoloader for the module
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();

        $loader->registerNamespaces([
            'App\Modules\Oauth\Controllers' => __DIR__ . '/Controllers/',
            'App\Modules\Oauth\Models'      => __DIR__ . '/Models/',
        ]);

        $loader->register();
    }

    /**
     * Register specific services for the module
     */
    public function registerServices(DiInterface $di = null)
    {
        // Registering a dispatcher
        $dispatcher = $di->get('dispatcher');
        $di->set('dispatcher', function() use ($dispatcher) {
            $dispatcher->setDefaultNamespace('App\Modules\Oauth\Controllers');

            return $dispatcher;
        });

        // Registering the view component
        $view = $di->get('view');
        $di->set('view', function() use ($view) {
            $view->setViewsDir(__DIR__ . '/views/');

            return $view;
        });
    }

}
