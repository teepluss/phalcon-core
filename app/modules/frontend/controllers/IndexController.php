<?php namespace App\Modules\Frontend\Controllers;

class IndexController extends BaseController {

    public function indexAction()
    {
        $this->events->fire('stock:increase', null, []);
        //die('Something');
    }

}