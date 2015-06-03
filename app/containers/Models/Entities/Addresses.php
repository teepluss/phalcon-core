<?php namespace App\Models\Entities;

use Sb\Framework\Mvc\Model\EagerLoadingTrait;

class Addresses extends BaseModel {

    use EagerLoadingTrait;

    public function initialize()
    {
        $this->belongsTo('user_id', 'App\Models\Entities\User', 'id', [
            'alias' => 'user'
        ]);

        $this->hasOne('id', 'App\Models\Entities\Locations', 'address_id', [
            'alias' => 'location'
        ]);
    }

    public function getSource()
    {
        return 'addresses';
    }

}