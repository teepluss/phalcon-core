<?php namespace App\Models\Entities;

use Phalcon\Mvc\Model\Validator\Uniqueness;
use Phalcon\Mvc\Model\Validator\InclusionIn;
use Sb\Framework\Mvc\Model\EagerLoadingTrait;

class Users extends BaseModel {

    use EagerLoadingTrait;

    public function initialize()
    {
        parent::initialize();

        $this->hasMany('id', 'App\Models\Entities\Addresses', 'user_id', [
            'alias' => 'addresses'
        ]);
    }

    public function getSource()
    {
        return 'users';
    }

    public function setPassword($password)
    {
        $security = $this->getDI()->getSecurity();

        $this->password = $security->hash($password);
    }

    public function validation()
    {
        $this->validate(new Uniqueness(
            array(
                'field'   => 'email',
                'message' => 'The email name must be unique'
            )
        ));

        return $this->validationHasFailed() != true;
    }

}