<?php

namespace League\OAuth2\Client\Test\Grant;

use \Mockery as m;

class AuthorizationCodeTest extends \PHPUnit_Framework_TestCase
{
    protected $provider;

    protected function setUp()
    {
        $this->provider = new \League\OAuth2\Client\Provider\Google(array(
            'clientId' => 'mock_client_id',
            'clientSecret' => 'mock_secret',
            'redirectUri' => 'none',
        ));
    }

    public function testGetAccessToken()
    {
        $grant = new \League\OAuth2\Client\Grant\AuthorizationCode();
        $this->assertEquals('authorization_code', (string) $grant);
    }

    /**
     * @expectedException BadMethodCallException
     */
    public function testInvalidRefreshToken()
    {
        $response = m::mock('Guzzle\Http\Message\Response');
        $response->shouldReceive('getBody')->times(2)->andReturn('{"access_token": "mock_access_token", "expires": 3600, "refresh_token": "mock_refresh_token", "uid": 1}');

        $client = m::mock('Guzzle\Service\Client');
        $client->shouldReceive('setBaseUrl')->times(1);
        $client->shouldReceive('post->send')->times(1)->andReturn($response);
        $this->provider->setHttpClient($client);

        $this->provider->getAccessToken('authorization_code', array('invalid_code' => 'mock_authorization_code'));
    }
}
