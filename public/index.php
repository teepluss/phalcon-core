<?php

error_reporting(E_ALL);

use Phalcon\Mvc\View;
use Phalcon\Mvc\Dispatcher;

try {

    // Logic.

    /**
     * Read the configuration
     */
    $config = include __DIR__ . "/../app/config/config.php";

    /**
     * Read auto-loader
     */
    include __DIR__ . "/../app/config/loader.php";

    /**
     * Read services
     */
    include __DIR__ . "/../app/config/services.php";

    /**
     * Handle the request
     */
    $app = new \Phalcon\Mvc\Application($di);

    $app->registerModules([
        'frontend' => [
            'className' => 'App\Modules\Frontend\Module',
            'path'      =>  __DIR__ . '/../app/containers/Modules/Frontend/Module.php'
        ]
    ]);

    echo $app->handle()->getContent();

} catch (\Exception $e) {
    echo $e->getMessage();
}
