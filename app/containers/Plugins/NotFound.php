<?php namespace App\Plugins;

use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Dispatcher\Exception as DispatchException;

class NotFound
{
	public function beforeException(Event $event, Dispatcher $dispatcher, $exception)
	{

		// handle 404
        if ($exception instanceof DispatchException) {
            $dispatcher->forward(array(
                'controller' => 'errors',
                'action'     => 'show404'
            ));
            return false;
        }

        //
        if ($event->getType() == 'beforeException') {
            switch ($exception->getCode()) {
                case \Phalcon\Dispatcher::EXCEPTION_HANDLER_NOT_FOUND:
                case \Phalcon\Dispatcher::EXCEPTION_ACTION_NOT_FOUND:
                    $dispatcher->forward(array(
                        'controller' => 'errors',
                        'action'     => 'show404'
                    ));
                    return false;
            }
        }
	}
}
