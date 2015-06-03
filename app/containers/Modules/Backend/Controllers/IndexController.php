<?php namespace App\Modules\Backend\Controllers;

class IndexController extends BaseController {

    public function indexAction()
    {
        $this->dispatcher->forward([
            'controller' => 'errors',
            'action'     => 'show400'
        ]);
    }

}