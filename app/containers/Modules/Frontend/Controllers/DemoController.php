<?php

namespace App\Modules\Frontend\Controllers;

use Phalcon\Mvc\View;
use GuzzleHttp\Client;
use Phalcon\Dispatcher;
use Phalcon\Mvc\Dispatcher\Exception;

class DemoController extends BaseController
{
    /**
     * Demo Index
     *
     * @return void
     */
    public function indexAction()
    {
        $this->tag->appendTitle('Demo Index');
    }

    public function guzzleAction()
    {
        $client = new Client(['base_uri' => 'https://api.cpone-dev.com']);

        $request = $client->post('/oauth/token', [
            'verify'   => false,
            'headers'  => [
                 'Authorization' => 'Basic Y2xpZW50OnNlY3JldA=='
            ],
            'form_params' => [
                'grant_type' => 'password',
                'username'   => '1909900116160',
                'password'   => 'password'
            ]
        ]);

        $response = (string) $request->getBody();

        $response = $this->response->setContent($response);

        return $response->send();
    }

    public function notfoundAction()
    {
        throw new Exception('Not found', Dispatcher::EXCEPTION_HANDLER_NOT_FOUND);
    }

    public function pushAction()
    {
        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
    }

    /**
     * Js Example
     *
     * eg. watchify public/assets/src/script -t babelify --outfile public/assets/js/bundle.js -d
     *
     * @return string
     */
    public function jsAction()
    {
        $this->tag->appendTitle('JavaScript ES6');

        $this->assets->collection('footer')->addJs('assets/js/bundle.js');
    }

    public function shareAction()
    {
        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
    }
}
