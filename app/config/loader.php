<?php

$loader = new \Phalcon\Loader();

/**
 * Composer autoload
 * Ref: http://forum.phalconphp.com/discussion/2016/composer-and-autoloading
 * PSR4 method by EThaiZone
 */

// include composer autoload psr4
$psr4 = require $config->application->vendorDir.'composer/autoload_psr4.php';
$composerAutoloadPsr4 = [];
foreach ($psr4 as $k => $values) {
    $k = trim($k, '\\');
    if (!isset($composerAutoloadPsr4[$k])) {
        $composerAutoloadPsr4[$k] = current($values) . '/';
    }
}

// include composer autoload namespace
$namespaces = require $config->application->vendorDir.'composer/autoload_namespaces.php';
$composerAutoloadNamespace = [];
foreach ($namespaces as $k => $values) {
    $k = trim($k, '\\');
    if (!isset($composerAutoloadNamespace[$k])) {
        $dir = '/' . str_replace('\\', '/', $k) . '/';
        $composerAutoloadNamespace[$k] = implode($dir . ';', $values) . $dir;
    }
}

// group all autoload and load as namespace in phalcom
$loader->registerNamespaces([
    'App' => $config->application->appDir.'containers/'
] + $composerAutoloadPsr4 + $composerAutoloadNamespace);

// include composer autoload classmap
$classMap = require $config->application->vendorDir . 'composer/autoload_classmap.php';
$loader->registerClasses($classMap);

// // include composer autoload files
$files = require $config->application->vendorDir . 'composer/autoload_files.php';
foreach($files as $file)
{
    require_once $file;
}

$loader->register();

require $config->application->helpersDir.'utilities.php';
