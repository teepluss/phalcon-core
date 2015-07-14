<?php

namespace App\Modules\Oauth\Controllers;

class TokenController extends BaseController
{
    public function indexAction()
    {
        $this->view->disable();

        $response = [];

        //try {
            $response = $this->oauth->authorize->issueAccessToken();

            $this->oauth->setData($response);
        // } catch (\Exception $e) {
        //     $this->oauth->catcher($e);
        // }

        $this->response->setContentType('application/json', 'UTF-8');

        $response = $this->response->setContent(json_encode($response));

        return $response->send();
    }
}