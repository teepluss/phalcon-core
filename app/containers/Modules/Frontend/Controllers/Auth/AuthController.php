<?php namespace App\Modules\Frontend\Controllers\Auth;

use Phalcon\Mvc\Controller;
use App\Modules\Frontend\Controllers\BaseController;
class AuthController extends BaseController 
{

	public function loginAction()
	{
		$isAuth = $this->session->get('auth');

		if($isAuth)
		{
			$this->response->redirect('/',true);
		}

		// set setitle
		$this->tag->appendTitle('Login');

		if ($this->request->isPost() && $this->security->checkToken()) 
		{
			$username = $this->request->getPost('username');
			$password = $this->request->getPost('password');
			if ( $username == 'a' && $password == 'a') {
				$this->session->set('auth',true);
				$this->response->redirect('/',true);
			}
		}
	}

	public function logoutAction() {
		$this->session->destroy();
	}	

	public function registerAction() {}

	public function forgetPasswordAction() {}

}