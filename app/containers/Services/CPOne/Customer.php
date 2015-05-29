<?php namespace App\Services\CPOne;

class Customer extends AbstractClient {

    public function sayHi($who = null, $body = true)
    {
        $path = 'customer/hi';
        if ($who)
        {
            $path .= $who;
        }
        return $this->output($this->guzzleClient->get($path), $body);
    }


    public function sendMessage($who, $msg, Array $optional = [], $body = true)
    {
        $path = 'customer/message';
        return $this->output(
            $this->guzzleClient->post($path, [
                'body' => json_encode(array_merge($optional, [
                    'username' => $who,
                    'message' => $msg,
                ])),
            ]
        ), $body);
    }
}