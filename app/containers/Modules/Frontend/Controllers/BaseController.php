<?php namespace App\Modules\Frontend\Controllers;

use Phalcon\Mvc\Controller;

abstract class BaseController extends Controller {

    public static $permissions = [];

    public function initialize()
    {
        $this->view->setTemplateAfter('common');

    	$this->tag->prependTitle('Frontend | ');
    }

}