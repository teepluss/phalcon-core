<?php

use Phalcon\Mvc\Router;

$router = new Router();

$router->setDefaultModule('frontend');
$router->removeExtraSlashes(true);

$router->add('/admin/:controller/:action/:params', [
    'module'     => 'backend',
    'controller' => 1,
    'action'     => 2,
    'params'     => 3
]);

$router->add('/admin/:controller', [
    'module'     => 'backend',
    'controller' => 1,
    'action'     => 'index'
]);

$router->add('/admin', [
    'module'     => 'backend',
    'controller' => 'index',
    'action'     => 'index'
]);

return $router;
