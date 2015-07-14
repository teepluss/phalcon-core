<?php

namespace App\Modules\Api\Controllers;

use App\Modules\Api\Models\Robots;
use App\Modules\Api\Models\Addresses;
use App\Modules\Api\Controllers\BaseController;

class MongoController extends BaseController
{
    public function initialize()
    {
        $this->robots = new Robots;
        $this->addresses = new Addresses;
    }

    public function indexAction()
    {

    }

    public function createAction()
    {
        $this->addresses->name = "Namax";
        $this->addresses->save();

        $ref = \MongoDBRef::create('addresses', $this->addresses->getId());

        $this->robots->name = "Iron Man";
        $this->robots->addresses = $ref;
        $this->robots->save();
    }

    public function editAction()
    {
        $robot = $this->robots->findFirst(['id' => '55882f2ab292c97011900523'])->toArray();

        $metas = \MongoDBRef::get($this->robots->getConnection(), $robot['addresses']);

        var_dump($robot, $metas);
        var_dump($robot['name'] . ' is comming from ' . $metas['name']);
    }
}