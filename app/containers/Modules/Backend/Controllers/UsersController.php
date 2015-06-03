<?php namespace App\Modules\Backend\Controllers;

use Phalcon\Db\Column;
use App\Models\Entities;
use Sb\Framework\Mvc\Model\EagerLoading\Loader;
use Sb\Framework\Mvc\Model\EagerLoading\QueryBuilder;

class UsersController extends BaseController {

    public function initialize()
    {
        $this->users = new Entities\Users;
    }

    public function indexAction()
    {
        $ids = "1,7";

        $users = $this->users->with('Addresses', [
            "conditions" => "id in ($ids)",
        ]);

        foreach ($users as $user)
        {
            foreach ($user->addresses as $address)
            {
                dump($address->toArray());
            }

        }

        dump($this->dbProfiler->output());
    }

    public function eagerAction()
    {
        $users = Loader::fromResultset($this->users->find(), ['Addresses', 'Addresses.Location' => function(QueryBuilder $query) {
            $query->where('id != ""');
        }]);

        foreach ($users as $user)
        {
            dump($user->toArray());
            foreach ($user->addresses as $address)
            {
                dump($address->toArray());
                if (isset($address->location))
                {
                    dump($address->location->toArray());
                }
            }
        }

        dump($this->dbProfiler->output());
    }

    public function createAction()
    {
        $this->users->assign([
            'email'     => 'teepluss@gmail.com',
            'password'  => '123456',
            'firstname' => 'Pattanai',
            'lastname'  => 'Kawinvasin'
        ]);

        $this->users->save();
    }

}