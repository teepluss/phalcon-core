<?php namespace App\Modules\Frontend\Controllers;

class IndexController extends BaseController {

    public function indexAction()
    {
        dump($this->config);
        $this->view->setVar("config", $this->config->toArray());
        //$this->events->fire('stock:increase', null, []);
    }

}