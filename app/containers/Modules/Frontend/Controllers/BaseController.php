<?php namespace App\Modules\Frontend\Controllers;

use Phalcon\Mvc\Controller;

abstract class BaseController extends Controller {

    public function initialize()
    {
    	$this->tag->prependTitle('Frontend | ');
        // $this->view->setTemplateAfter('common');

		$this->assets
		    ->collection('header')
			->setPrefix('/')
			->setLocal(false)
		    ->addJs('js/jquery-1.11.3.min.js')
		    ->addJs('bootstrap/js/bootstrap.min.js')
		    ->addCss('bootstrap/css/bootstrap.min.css');

		$this->assets
		    ->collection('footer')
			->setPrefix('/')
			->setLocal(false);
    }

}