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

var_dump(file_exists($config->application->vendorDir.'raveren/kint/'));
exit;
$kintFile = $config->application->vendorDir.'raveren/kint/Kint.class.php';
if (file_exists($kintFile))
{
    require_once $kintFile;
}

$loader->register();

require $config->application->helpersDir.'utilities.php';