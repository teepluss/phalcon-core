<?php namespace App\Modules\Frontend\Controllers;

use Phalcon\Mvc\Controller;

class BaseController extends Controller {

    public function initialize()
    {
    	$this->tag->prependTitle('Frontend | ');
        $this->view->setTemplateAfter('main');
    }

}