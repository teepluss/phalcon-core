<?php namespace App\Models\Entities;

use Sb\Framework\Mvc\Model\EagerLoadingTrait;

class Locations extends BaseModel {

    use EagerLoadingTrait;

    public function getSource()
    {
        return 'locations';
    }

}