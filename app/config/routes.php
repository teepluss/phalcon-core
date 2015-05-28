<?php

use Phalcon\Mvc\Router;
use Phalcon\Http\Response;
use Phalcon\Mvc\Router\Group as RouterGroup;

$router = new Router();
$router->setDefaultModule('frontend');

$frontend = new RouterGroup;

$frontend->setPaths([
    'module' => 'frontend'
]);

$frontend->setPrefix('/');

$frontend->add('/', array(
    'controller' => 'index',
    'action'     => 'index',
));

// Register routes
$router->mount($frontend);

return $router;