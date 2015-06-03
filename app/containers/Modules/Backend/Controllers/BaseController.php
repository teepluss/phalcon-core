<?php namespace App\Modules\Backend\Controllers;

use Phalcon\Mvc\Controller;

abstract class BaseController extends Controller {

    public function initialize()
    {
        $this->tag->prependTitle('Backend | ');
    }

}