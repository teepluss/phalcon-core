<?php

use Phalcon\Mvc\Router;
use Phalcon\Http\Response;
use Phalcon\Mvc\Router\Group as RouterGroup;

$router = new Router();

/*
$router->setDefaultModule("frontend");

$frontend = new RouterGroup([
    'module' => 'frontend'
]);

$frontend->setPrefix('/front');

$frontend->add('/', array(
    'controller' => 'index',
    'action'     => 'index',
));

$frontend->beforeMatch(function($uri, $route) {
    if ( ! isset($_GET['password'])) {
        die('xxx');
    }

    return true;
});

$router->mount($frontend);

return $router;

*/

return $router;