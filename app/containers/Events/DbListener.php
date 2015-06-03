<?php namespace App\Events;

use Phalcon\Db\Profiler;

class DBListener {

    protected $profiler;

    /**
     * Creates the profiler and starts the logging
     */
    public function __construct(Profiler $profiler)
    {
        $this->profiler = $profiler;
    }

    /**
     * This is executed if the event triggered is 'beforeQuery'
     */
    public function beforeQuery($event, $connection)
    {
        $this->profiler->startProfile($connection->getSQLStatement());
    }

    /**
     * This is executed if the event triggered is 'afterQuery'
     */
    public function afterQuery($event, $connection)
    {
        $this->profiler->stopProfile();
    }

}