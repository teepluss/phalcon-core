<?php namespace App\Modules\Oauth\Controllers;

use Phalcon\Mvc\Controller;

abstract class BaseController extends Controller {

    public static $permissions = [];

    public function initialize()
    {
        $this->view->setTemplateAfter('common');

        $this->tag->prependTitle('Oauth | ');
    }

}