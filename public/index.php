<?php

error_reporting(E_ALL);

use Phalcon\Mvc\View;
use Phalcon\Mvc\Dispatcher;

/**
 * Error handler
 */
// set_exception_handler(function(Exception $e) {
//     dump(get_class($e) . ':' . $e->getMessage(),
//         'File: ' . $e->getFile(),
//         'Line: ' . $e->getLine(),
//         $e->getTraceAsString()
//     );
// });

/**
 * Get current environment
 * @return String|Null Environment name or null
 */
function getEnvironment()
{
    static $currentEnv = null;

    if (!is_null($currentEnv)) {
        return $currentEnv ?: null;
    }

    $currentEnv = false;

    $environments = array(
        'develop' => array('*.app')
    );

    $domain = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : null;

    $hostname = gethostname();

    foreach ($environments as $environment => $hosts) {
        // To determine the current environment, we'll simply iterate through the possible
        // environments and look for the host that matches the host for this request we
        // are currently processing here, then return back these environment's names.
        foreach ((array) $hosts as $host) {
            $hostPattern = preg_quote($host, '#');
            $hostPattern = str_replace('\*', '.*', $hostPattern).'\z';

            if (
                (bool) preg_match('#^'.$hostPattern.'#', $domain)
                || ($host == $domain)
                || ($host == $hostname)
            ) {
                $currentEnv = $environment;
                return $environment;
            }
        }
    }

    return null;
}

/**
 * Merge configuration
 */
$config = include __DIR__ . "/../app/config/config.php";
if ($env = getEnvironment()) {
    $envConfig = include __DIR__ . "/../app/config/config.".$env.".php";
    $config->merge($envConfig);
}

/**
 * Read auto-loader
 */
include __DIR__ . "/../app/config/loader.php";

/**
 * Read services
 */
include __DIR__ . "/../app/config/services.php";

/**
 * Register Phalcon console
 */
new Vanchelo\Console\ConsoleService($di);

/**
 * Handle the request
 */
$app = new \Phalcon\Mvc\Application($di);

$app->registerModules([
    'frontend' => [
        'className' => 'App\Modules\Frontend\Module',
        'path'      =>  __DIR__ . '/../app/containers/Modules/Frontend/Module.php'
    ],
    'backend'  => [
        'className' => 'App\Modules\Backend\Module',
        'path'      => __DIR__ . '/../app/containers/Modules/Backend/Module.php'
    ],
    'oauth'    => [
        'className' => 'App\Modules\Oauth\Module',
        'path'      => __DIR__ . '/../app/containers/Modules/Oauth/Module.php'
    ],
    'api'      => [
        'className' => 'App\Modules\Api\Module',
        'path'      => __DIR__ . '/../app/containers/Modules/Api/Module.php'
    ],
]);

echo $app->handle()->getContent();
