<?php namespace App\Modules\Frontend\Controllers;

class IndexController extends BaseController {

    public function indexAction()
    {
		// set setitle
		$this->tag->appendTitle('Index');

        $this->view->setVar("config", $this->config->toArray());
    }

}