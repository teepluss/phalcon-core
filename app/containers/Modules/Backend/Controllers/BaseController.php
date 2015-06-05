<?php namespace App\Modules\Backend\Controllers;

use Phalcon\Mvc\Controller;

abstract class BaseController extends Controller {

    public function initialize()
    {
        $this->view->setTemplateAfter('common');

        $this->tag->prependTitle('Backend | ');

        // Preparing theme.
        $this->assets
            ->collection('header')
            ->setPrefix('/')
            ->setLocal(false)
            ->addCss('assets/vendor/bootstrap/dist/css/bootstrap.min.css')
            ->addCss('assets/vendor/bootstrap/dist/css/bootstrap-theme.min.css')
            ->addCss('assets/css/backend/dashboard.css');

        $this->assets
            ->collection('footer')
            ->setPrefix('/')
            ->setLocal(false)
            ->addJs('assets/vendor/jquery/dist/jquery.min.js')
            ->addJs('assets/vendor/bootstrap/dist/js/bootstrap.min.js')
            ->addJs('assets/vendor/holderjs/holder.js')
            ->addJs('assets/vendor/i18next/i18next.commonjs.withJQuery.min.js');

        // $this->assets
        //     ->collection('footer')
        //     ->addInlineJs('console.log("Demo")');
    }

}