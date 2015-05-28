<?php

use Phalcon\Mvc\Router;
use Phalcon\Http\Response;
use Phalcon\Mvc\Router\Group as RouterGroup;
use App\Config\Routes;

$router = new Router();
$router->setDefaultModule('frontend');


// Register routes
$router->mount(new Routes\Frontend\Home);
$router->mount(new Routes\Frontend\Blog);

return $router;