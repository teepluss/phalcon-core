<?php

namespace App\Modules\Frontend\Controllers;

use Phalcon\Mvc\Controller;

abstract class BaseController extends Controller {

    public static $permissions = [];

    public function initialize()
    {
        $this->view->setTemplateAfter('common');

        // HTML meta tags
    	$this->tag->prependTitle('Frontend | ');

        // Preparing assets collection
        $this->assets
            ->addCss('assets/vendor/material-design-lite/material.min.css')
            ->addCss('//fonts.googleapis.com/icon?family=Material+Icons', false)
            ->addCss('assets/css/font-custom.css')
            ->addCss('assets/css/frontend/styles.css');

        $this->assets
            ->addJs('assets/vendor/material-design-lite/material.min.js');

        //$this->assets->collection('footer');
    }

}