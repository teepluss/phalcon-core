<?php

use Phalcon\Mvc\Router\Group;

// Backend: home
$backend['home'] = new Group([
    'module'     => 'backend',
    'controller' => 'index',
]);
$backend['home']->setPrefix('/admin');

$backend['home']->add('', [
    'action' => 'index'
]);

// Backend: users
$backend['users'] = new Group([
    'module'     => 'backend',
    'controller' => 'users'
]);
$backend['users']->setPrefix('/admin/users');

$backend['users']->add('', [
    'action' => 'index'
]);

$backend['users']->add('/create', [
    'action' => 'create'
]);

$backend['users']->add('/eager', [
    'action' => 'eager'
]);

return $backend;