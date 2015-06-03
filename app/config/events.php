<?php

use Phalcon\Events\Manager as EventsManager;

$eventsManager = new EventsManager;

$eventsManager->attach('stock:increase', function($events) {

    //dump($events->getSource());

    die('stock increase');
});

$eventsManager->attach('stock:decrease', function($events) {
    die('stock decrease');
});

return $eventsManager;
