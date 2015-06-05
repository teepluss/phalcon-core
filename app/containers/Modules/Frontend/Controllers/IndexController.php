<?php namespace App\Modules\Frontend\Controllers;

use App\Models\Entities\Users;

class IndexController extends BaseController {

    public function indexAction()
    {
        $this->tag->appendTitle('Index');

        $this->view->setVar("config", $this->config->toArray());

        //$this->repositories->get('User\User');
    }

}