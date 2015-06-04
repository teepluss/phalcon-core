<?php namespace App\Models\Entities;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Behavior\Timestampable;

abstract class BaseModel extends Model {

    public function initialize()
    {
        $this->addBehavior(new Timestampable(
            array(
                'beforeCreate'  => array(
                    'field'     => 'created_at',
                    'format'    => 'Y-m-d H:i:s'
                )
            )
        ));
    }

    // public function beforeCreate()
    // {
    //     //Set the creation date
    //     $this->created_at = date('Y-m-d H:i:s');
    // }

    // public function beforeUpdate()
    // {
    //     //Set the modification date
    //     $this->updated_at = date('Y-m-d H:i:s');
    // }

}