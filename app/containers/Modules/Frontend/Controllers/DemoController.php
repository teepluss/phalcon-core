<?php namespace App\Modules\Frontend\Controllers;

use GuzzleHttp\Client;

class DemoController extends BaseController {

    public function indexAction()
    {
        die('Diet Pepsi');
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
                'username' => '1909900116160',
                'password' => 'password'
            ]
        ]);

        $response = (string) $request->getBody();

        $response = $this->response->setContent($response);

        return $response->send();
    }

}