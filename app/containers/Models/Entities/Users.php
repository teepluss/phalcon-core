<?php namespace App\Models\Entities;

use Sb\Framework\Mvc\Model\EagerLoadingTrait;

class Users extends BaseModel {

    use EagerLoadingTrait;

    public function initialize()
    {
        $this->hasMany('id', 'App\Models\Entities\Addresses', 'user_id', [
            'alias' => 'addresses'
        ]);
    }

    public function getSource()
    {
        return 'users';
    }

}