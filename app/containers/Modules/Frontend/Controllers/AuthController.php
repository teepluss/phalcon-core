<?php namespace App\Modules\Frontend\Controllers;

use Phalcon\Mvc\Controller;

class AuthController extends BaseController 
{

	public function loginAction()
	{
		// set setitle
		$this->tag->appendTitle('Login');

		$isAuth = $this->session->get('auth');

		if($isAuth)
		{
			$this->response->redirect('/',true);
		}

		if ($this->request->isPost() && $this->security->checkToken()) 
		{
			$username = $this->request->getPost('username');
			$password = $this->request->getPost('password');
			if ( $username == 'a' && $password == 'a') {
				$this->session->set('auth',true);
				$this->response->redirect('/user',true);
			}
		}
	}

	public function logoutAction() {
		// set setitle
		$this->tag->appendTitle('Logout');

		$this->session->destroy();
	}	

	public function registerAction() {}

	public function forgetPasswordAction() {}

}