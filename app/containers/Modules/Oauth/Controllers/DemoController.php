<?php

namespace App\Modules\Oauth\Controllers;

use GuzzleHttp\Client;

class DemoController extends BaseController
{
    protected $client;

    public function initialize()
    {
        $this->client = new Client([
            'base_uri' => $this->url->get('/'),
            'timeout'  => 2.0,
        ]);
    }

    public function indexAction()
    {
        // Start example here.
    }

    public function codeAction()
    {
        $this->view->disable();

        $params = [
            'client_id'     => 'testclient',
            'redirect_uri'  => $this->url->get('/oauth/demo/code'),
            'response_type' => 'code',
            'scope'         => 'basic,photo'
        ];

        if ($this->request->has('code')) {

            $postdata = array_merge($params, [
                'client_secret' => 'secret',
                'grant_type'    => 'authorization_code',
                'code'          => $this->request->get('code')
            ]);

            try {

                $request = $this->client->post('/oauth/token', [
                    'form_params' => $postdata
                ]);

                $response = $request->getBody();
                $response = json_decode($response, true);

                dump($response); exit(0);
            } catch (\GuzzleHttp\Exception\ClientException $e) {
                ddd($e->getMessage());
            }
        }

        $redirectUri = $this->url->get('/oauth/auth/authorize?' . http_build_query($params));

        return $this->response->redirect($redirectUri);
    }

    public function passwordAction()
    {
        $this->view->disable();

        //try {

            $request = $this->client->post('/oauth/token', [
                'form_params' => [
                    'client_id'     => 'testclient',
                    'client_secret' => 'secret',
                    'grant_type'    => 'password',
                    'username'      => 'teepluss@gmail.com',
                    'password'      => '123456!'
                ]
            ]);

            $response = $request->getBody();

            $response = json_decode($response, true);

            dump($response); exit(0);
        // } catch (\GuzzleHttp\Exception\ClientException $e) {
        //     ddd($e->getResponse());
        // }
    }

    public function clientAction()
    {
        $this->view->disable();

        $request = $this->client->post('/oauth/token', [
            'form_params' => [
                'client_id'     => 'testclient',
                'client_secret' => 'secret',
                'grant_type'    => 'client_credentials'
            ]
        ]);

        $response = $request->getBody();

        $response = json_decode($response, true);

        dump($response); exit(0);
    }

    public function refreshAction()
    {
        $this->view->disable();

        //try {

            $request = $this->client->post('/oauth/token', [
                'form_params' => [
                    'client_id'     => 'testclient',
                    'client_secret' => 'secret',
                    'grant_type'    => 'refresh_token',
                    'refresh_token' => 'eYhE1PswFC9kp5Iv5qcNpET4dkD43evIheOaOAQY',
                ]
            ]);

            $response = $request->getBody();


            $response = json_decode($response, true);

            dump($response); exit(0);
        // } catch (\GuzzleHttp\Exception\ClientException $e) {
        //     ddd($e->getResponse());
        // }
    }
}
