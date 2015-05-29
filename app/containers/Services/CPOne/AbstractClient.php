<?php namespace App\Services\CPOne;

abstract class AbstractClient {

    /**
     * Client base url endpoint
     * @var string
     */
    static protected $baseUrl = 'https://cpone/api/';

    /**
     * Guzzle Client
     * @see \GuzzleHttp\Client
     */
    protected $guzzleClient;

    /**
     * Access token
     * @var string
     */
    public $accessToken;

    public function __construct($accessToken)
    {
        $this->guzzleClient = new \GuzzleHttp\Client([
            'base_url' => [ static::$baseUrl, ['version' => null ] ],
            'defaults' => [
                'headers' => [
                    'content-type'  => 'application/json',
                    'Authorization' => 'Bearer '.$accessToken
                ],
            ]
        ]);
    }

    /**
     * Set a custom Guzzle client for http requests
     * @param GuzzleHttpClient $client Custom Guzzle client
     */
    public function setGuzzleClient(\GuzzleHttp\Client $client)
    {
        $this->guzzleClient = $client;
        return $this;
    }

    /**
     * Output
     * 
     * @param  Guzzle\Http\Message\Response $response Guzzle response object 
     * @param  boolean $body 
     * @return Array|Guzzle\Http\Message\Response Guzzle response body|object 
     */
    protected function output($response, $body) 
    {
        return $body ? $response->json() : $response;
    }
}