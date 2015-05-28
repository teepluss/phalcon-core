<?php

$baseUri = realpath(__DIR__ . '/../../');

return new \Phalcon\Config(array(
    'database' => array(
        'adapter'     => 'Mysql',
        'host'        => 'localhost',
        'username'    => 'root',
        'password'    => '',
        'dbname'      => 'test',
        'charset'     => 'utf8',
    ),
    'application' => array(
        'storageDir' => $baseUri . '/storage/',
        'vendorDir'  => $baseUri . '/vendor/',
        'appDir'     => $baseUri . '/app/',
        'viewsDir'   => $baseUri . '/views/',
        'helpersDir' => $baseUri . '/app/helpers/',
        'baseUri'    => $baseUri . '/',
    ),
));
