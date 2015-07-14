<?php

use Phalcon\Mvc\Router as PhRouter;

class Router extends PhRouter
{
    public function getRewriteUri()
    {
        $originalUri = parent::getRewriteUri();

        if (preg_match('~(/(th|en))~', $originalUri, $matches)) {
            $originalUri = str_replace($matches[1], '', $originalUri);
        }

        return $originalUri;
    }
}

$router = new Router();

$router->setDefaultModule('frontend');
$router->removeExtraSlashes(true);

$mappings = [
    'front'   => [
        'prefix' => 'front',
        'module' => 'frontend'
    ],
    'admin'   => [
        'prefix' => 'admin',
        'module' => 'backend'
    ],
    'oauth'   => [
        'prefix' => 'oauth',
        'module' => 'oauth'
    ],
    'api'     => [
        'prefix' => 'api',
        'module' => 'api'
    ],
];

foreach ($mappings as $key => $val) {
    $router->add('/'.$val['prefix'].'/:controller/:action/:params', [
        'module'     => $val['module'],
        'controller' => 1,
        'action'     => 2,
        'params'     => 3
    ]);

    $router->add('/'.$val['prefix'].'/:controller', [
        'module'     => $val['module'],
        'controller' => 1,
        'action'     => 'index'
    ]);

    $router->add('/'.$val['prefix'].'', [
        'module'     => $val['module'],
        'controller' => 'index',
        'action'     => 'index'
    ]);
}

return $router;
