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

$kintFile = $config->application->vendorDir.'raveren/kint/Kint.class.php';
// if (file_exists($kintFile))
// {
// var_dump($kintFile);
    require_once $kintFile;
// }

$loader->register();

require $config->application->helpersDir.'utilities.php';