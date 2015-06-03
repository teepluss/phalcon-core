<?php

use Phalcon\Mvc\Router\Group;

// Frontend: home
$frontend['home'] = new Group([
    'module'     => 'frontend',
    'controller' => 'index'
]);
$frontend['home']->setPrefix('/admin');

$frontend['home']->add('', [
    'action' => 'index',
]);

// Frontend: auth
$frontend['auth'] = new Group([
    'module'     => 'frontend',
    'controller' => 'auth'
]);
$frontend['auth']->setPrefix('/auth');

$frontend['auth']->add('/login', [
    'action' => 'login',
]);

$frontend['auth']->add('/logout', [
    'action' => 'logout',
]);

return $frontend;