<?php

namespace App\Modules\Api\Models;

use Phalcon\Mvc\Collection;

class Addresses extends Collection {

    public function getSource()
    {
        return 'addresses';
    }

}