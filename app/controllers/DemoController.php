<?php

class DemoController extends ControllerBase {

    public static $permissions = [
        'index'  => 'demo.view',
        'view'   => 'demo.view',
        'create' => 'demo.write',
        'edit'   => 'demo.write',
        'delete' => 'demo.delete'
    ];

    public function initialize()
    {
        $this->view->setTemplateAfter('common');
    }

    public function indexAction()
    {

        //$this->events->fire('stock:increase', $this, ['id' => 1, 'stock' => 1]);

        //dump(get_class_methods($this->events)); exit(0);
    }

    public function viewAction()
    {

    }

    public function createAction()
    {
    }

    public function editAction()
    {

        //$this->events->fire('stock:increase', $this, ['id' => 1, 'stock' => 1]);

        //dump(get_class_methods($this->events)); exit(0);
    }

    public function destroyAction()
    {

    }



}