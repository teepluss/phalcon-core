<?php namespace App\Modules\Frontend\Controllers;

use Phalcon\Mvc\Controller;

abstract class BaseController extends Controller {

    public function initialize()
    {
        $this->view->setTemplateAfter('common');

    	$this->tag->prependTitle('Frontend | ');
    }

}