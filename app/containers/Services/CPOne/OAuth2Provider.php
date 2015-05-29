<?php namespace App\Services\CPOne;

use \League\OAuth2\Client\Token\AccessToken as AccessToken;

class OAuth2Provider extends \League\OAuth2\Client\Provider\AbstractProvider
{
    public function __construct($options)
    {
        parent::__construct($options);
        $this->headers = array(
            // 'Authorization' => 'Bearer'
        );
    }
    
    public function urlAuthorize()
    {
        return 'https://cpone/api/authenticate/';
    }
    public function urlAccessToken()
    {
        return 'https://cpone/api/oauth2/access_token/';
    }

    public function urlUserDetails(AccessToken $token) {}
    public function userDetails($response, AccessToken $token) {}
    public function userUid($response, AccessToken $token) {}
}