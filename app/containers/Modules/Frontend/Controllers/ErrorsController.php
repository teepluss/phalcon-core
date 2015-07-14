<?php namespace App\Modules\Frontend\Controllers;

use Phalcon\Mvc\View;
use Phalcon\Mvc\Controller;

class ErrorsController extends Controller
{
	public function initialize()
    {
    	$this->view->setViewsDir(__DIR__ . '/../views/');
        $this->view->disableLevel(array(
        	View::LEVEL_LAYOUT      => true,
        	View::LEVEL_MAIN_LAYOUT => true
    	));
    }

	public function show400Action()
	{
		$this->response->setStatusCode(400);
		$this->tag->appendTitle('Error 400');
	}

	public function show401Action()
	{
		$this->response->setStatusCode(401);
		$this->tag->appendTitle('Error 401');
	}

	public function show404Action()
	{
		$this->response->setStatusCode(404);
		$this->tag->appendTitle('Error 404');

		return $this->view->render('errors', 'show404');
	}

	public function show500Action()
	{
		$this->response->setStatusCode(500);
		$this->tag->appendTitle('Error 500');
	}

	public function show503Action()
	{
		$this->response->setStatusCode(503);
		$this->tag->appendTitle('Error 503');
	}
}
