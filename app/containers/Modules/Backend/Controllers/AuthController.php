<?php namespace App\Modules\Backend\Controllers;

class AuthController extends BaseController {

    public function loginAction()
    {
        // Check if the cookie has previously set
        if ($this->cookies->has('remember-me')) {

            // Get the cookie
            $rememberMe = $this->cookies->get('remember-me');

            // Get the cookie's value
            $value      = $rememberMe->getValue();

            dump($value);
        }

        exit(0);
    }

    public function startAction()
    {
        $this->cookies->set('remember-me', 'some value This is test asddsf xxx ss 33434453', time() + 15 * 86400);

        return $this->response->redirect('/admin/auth/login');
    }

    public function logoutAction()
    {
        $this->cookies->get('remember-me')->delete();

        return $this->response->redirect('/admin/auth/login');
    }

}