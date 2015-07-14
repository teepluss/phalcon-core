<?php

namespace App\Modules\Api\Controllers;

use Phalcon\Mvc\View;
use Phalcon\Mvc\Controller;

abstract class BaseController extends Controller {

    public static $permissions = [];

    public function initialize()
    {
        $this->view->setRenderLevel(View::LEVEL_NO_RENDER);

        $this->tag->prependTitle('Api | ');
    }

}