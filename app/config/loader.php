<?php

$loader = new \Phalcon\Loader();


$loader->registerNamespaces([
    'Symfony\Component\VarDumper' => $config->application->vendorDir.'symfony/var-dumper/'
]);

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs(
    array(
        $config->application->controllersDir,
        $config->application->modelsDir
    )
);

$loader->register();

require $config->application->helpersDir.'utilities.php';