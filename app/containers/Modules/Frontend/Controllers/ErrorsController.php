<?php namespace App\Modules\Frontend\Controllers;

use Phalcon\Mvc\Controller;

class ErrorsController extends BaseController
{

	public function show400Action() {
		// set setitle
		$this->tag->appendTitle('Error 400');
	}

	public function show401Action() {
		// set setitle
		$this->tag->appendTitle('Error 401');
	}

	public function show404Action() {
		// set setitle
		$this->tag->appendTitle('Error 404');
	}

	public function show500Action() {
		// set setitle
		$this->tag->appendTitle('Error 500');
	}

	public function show503Action() {
		// set setitle
		$this->tag->appendTitle('Error 503');
	}
}