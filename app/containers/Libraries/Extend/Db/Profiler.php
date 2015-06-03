<?php namespace App\Libraries\Extend\Db;

use Phalcon\Db\Profiler as DbProfiler;

class Profiler extends DbProfiler {

    public function output()
    {
        $profilers = $this->getProfiles();

        $output = [];

        foreach ($profilers as $profile)
        {
            $output[] = $profile->getSQLStatement();
        }

        return $output;
    }

}