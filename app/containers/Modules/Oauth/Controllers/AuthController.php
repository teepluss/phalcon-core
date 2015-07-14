<?php

namespace App\Modules\Oauth\Controllers;

class AuthController extends BaseController
{
    public function initialize()
    {
        parent::initialize();

        $this->users = $this->repositories->uses('User');
    }

    public function authorizeAction()
    {
        $authParams = [];

        // This code is filtering the right input.
        try {
            $codeGrant = $this->oauth->authorize->getGrantType('authorization_code');
            $authParams = $codeGrant->checkAuthorizeParams();
        } catch (\Exception $e) { // The most case is missing paremeter.
            return $this->oauth->catcher($e);
        }

        if (!$this->session->has('authuser')) {
            $currentUrl = $this->url->get($_SERVER['REQUEST_URI']);

            $this->session->set('intended', $currentUrl);

            return $this->response->redirect('/oauth/auth/signin');
        }

        if ($this->request->isPost()) {
            if ($this->request->getPost('approve') == 'approve') {
                $auth = $this->session->get('authuser');

                $redirectUri = $codeGrant->newAuthorizeRequest('user', $auth['id'], $authParams);

                return $this->response->redirect($redirectUri);
            }

            if ($this->request->getPost('approve') != 'approve') {
                die('Sorry, no where else to go.');
            }
        }

        $params = $this->request->get();
        unset($params['_url']);

        // Display view with params.
        $this->view->setVars(compact('params'));
    }

    public function signinAction()
    {
        $credentials = ['username' => 'password'];

        $username = $this->request->getServer('PHP_AUTH_USER');
        $password = $this->request->getServer('PHP_AUTH_PW');

        if (isset($credentials[$username]) and $credentials[$username] == $password) {
            $previousUrl = $this->session->get('intended');

            $authuser = $this->users->findById(1)->toArray();
            unset($authuser['password']);

            $this->session->set('authuser', $authuser);

            return $this->response->redirect($previousUrl);
        }

        $this->response->setStatusCode(401, 'Not authorize');
        $this->response->setHeader('WWW-Authenticate', 'Basic');

        return $this->response->send();
    }

    public function logoutAction()
    {
        $this->view->disable();

        $this->session->remove('authuser');

        $this->response->setContent('OK');

        return $this->response->send();
    }
}