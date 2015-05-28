<?php namespace App\Plugins;

use Phalcon\Acl;
use Phalcon\Acl\Role;
use Phalcon\Acl\Resource;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Acl\Adapter\Memory as AclList;

class Security extends Plugin {

    public function beforeDispatch(Event $events, Dispatcher $dispatcher)
    {
        // What you want to do?
    }

}