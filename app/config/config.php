<?php

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
        'storageDir' => __DIR__ . '/../../storage/',
        'vendorDir'  => __DIR__ . '/../../vendor/',
        'appDir'     => __DIR__ . '/../',
        'viewsDir'   => __DIR__ . '/../views/',
        'helpersDir' => __DIR__ . '/../helpers/',
        'baseUri'    => __DIR__ . '/../../',
    ),
));
