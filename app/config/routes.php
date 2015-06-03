<?php

use Phalcon\Mvc\Router;

$router = new Router();
$router->setDefaultModule('frontend');
$router->removeExtraSlashes(true);

$routes = [
    'frontend' => require __DIR__ . '/routes/frontend.php',
    'backend'  => require __DIR__ . '/routes/backend.php'
];

foreach ($routes as $module => $controllers)
{
    foreach ($controllers as $mount)
    {
        $router->mount($mount);
    }
}

return $router;
