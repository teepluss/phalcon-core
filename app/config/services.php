<?php

use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Flash\Direct as FlashDirect;
use Phalcon\Flash\Session as FlashSession;
use Phalcon\Security;
use App\Libraries\Extend\Db\Profiler as DbProfiler;
use Phalcon\Crypt;

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();

$di->set('config', $config);

$di->set('dispatcher', function() {

    $eventsManager = new EventsManager;

    /**
     * Check if the user is allowed to access certain action using the SecurityPlugin
     */
    $eventsManager->attach('dispatch:beforeDispatch', new App\Plugins\Security());

    /**
     * Handle exceptions and not-found exceptions using NotFoundPlugin
     */
    $eventsManager->attach('dispatch:beforeException', new App\Plugins\NotFound());

    $dispatcher = new Dispatcher;
    $dispatcher->setEventsManager($eventsManager);

    return $dispatcher;

});

/**
 * Global events
 */
$di->set('events', function() {
    return require __DIR__ . '/events.php';
});

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->set('url', function () use ($config) {
    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUrl);

    return $url;
}, true);

/**
 * Setting up the view component
 */
$di->set('view', function () use ($config) {

    $view = new View();

    $view->setViewsDir($config->application->viewsDir);

    $view->registerEngines(array(
        '.volt' => function ($view, $di) use ($config) {

            $volt = new VoltEngine($view, $di);

            $volt->setOptions(array(
                'compiledPath' => $config->application->storageDir.'cache/',
                'compiledSeparator' => '_'
            ));

            return $volt;
        },
        '.phtml' => 'Phalcon\Mvc\View\Engine\Php'
    ));

    return $view;
}, true);

/**
 * Database profiler.
 */
$dbProfiler = new DbProfiler;
$di->set('dbProfiler', $dbProfiler);

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->set('db', function () use ($config, $dbProfiler) {
    $eventsManager = new EventsManager();
    $eventsManager->attach('db', new App\Events\DbListener($dbProfiler));

    $connection = new DbAdapter($config->database->toArray());
    $connection->setEventsManager($eventsManager);

    return $connection;
});

/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->set('modelsMetadata', function () {
    return new MetaDataAdapter();
});

/**
 * Start the session the first time some component request the session service
 */
$di->set('session', function () {
    $session = new SessionAdapter();
    $session->start();

    return $session;
});

/**
 * Set routes
 */
$di->set('router', function() {
    return require __DIR__.'/routes.php';
});

/**
 * Security
 */
$di->set('security', function() {
    $security = new Security();

    //Set the password hashing factor to 12 rounds
    $security->setWorkFactor(12);

    return $security;
});

/**
 * Set flash direct
 */
$di->set('flash', function() {
    $flash = new FlashDirect(array(
        'error'   => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice'  => 'alert alert-info',
        'warning' => 'alert alert-warning'
    ));
    return $flash;
});

/**
 * Flash session
 */
$di->set('flashSession', function() {
    $flash = new FlashSession(array(
        'error'   => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice'  => 'alert alert-info',
        'warning' => 'alert alert-warning'
    ));
    return $flash;
});

/**
 * Translation
 */
$di->set('translate', function() use ($di, $config) {
    $language = $di->get('request')->getBestLanguage();
    $language = "th";

    $messagesDir = $config->application->messagesDir;

    // Check if we have a translation file for that lang
    if (file_exists($messagesDir.$language.'/messages.php'))
    {
       $content = require $messagesDir.$language.'/messages.php';
    }
    else
    {
       // Fallback to some default
       $content = require $messagesDir.'en/messages.php';
    }

    // Return a translation object
    // return new \Phalcon\Translate\Adapter\NativeArray([
    //    "content" => $content
    // ]);

    return new \App\Libraries\Extend\Translate\Adapter\NativeArray([
        "content" => $content
    ]);

}, true);

/**
 * MongoDB
 */
$di->set('mongo', (new MongoClient())->selectDB('demo'), true);

/**
 * MongoDB collection
 */
$di->set('collectionManager', new Phalcon\Mvc\Collection\Manager(), true);

/**
 * Repositories
 */
$di->set('repositories', function() use ($di) {
    $repositories = new App\Models\Repositories\Repositories;

    $repositories->setDi($di);

    return $repositories;
}, true);

/**
 * Cookie
 */
$di->set('cookies', function() {
    $cookies = new Phalcon\Http\Response\Cookies();
    $cookies->useEncryption(true);
    return $cookies;
});

/**
 * Encryption
 */
$di->set('crypt', function() {
    $crypt = new Crypt();
    $crypt->setMode(MCRYPT_MODE_CFB);
    $crypt->setKey('#1dj8$=dp?.ak/s#/j1Vw45$'); // Use your own key!
    return $crypt;
});

/**
 * Oauth Server
 */
$di->set('oauth', function () {
    $oauth = new App\Plugins\Oauth2\Server\StandaloneWrapper();
    $oauth->initAuthorizationServer();
    $oauth->initResourceServer();
    $oauth->enableAllGrants();

    return $oauth;
});
