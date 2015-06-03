<?php namespace App\Models\Entities;

use Phalcon\Mvc\Model;

abstract class BaseModel extends Model {

    public function beforeCreate()
    {
        //Set the creation date
        $this->created_at = date('Y-m-d H:i:s');
    }

    public function beforeUpdate()
    {
        //Set the modification date
        $this->updated_at = date('Y-m-d H:i:s');
    }

}