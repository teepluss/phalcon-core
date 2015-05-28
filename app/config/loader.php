<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
// $loader->registerDirs([
//     $config->application->controllersDir,
//     $config->application->modelsDir
// ]);

$loader->registerNamespaces([
    'App' => $config->application->appDir.'containers/',
    'Symfony\Component\VarDumper' => $config->application->vendorDir.'symfony/var-dumper/',
]);

$loader->register();

//require $config->application->helpersDir.'utilities.php';