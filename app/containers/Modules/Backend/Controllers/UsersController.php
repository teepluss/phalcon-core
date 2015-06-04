<?php namespace App\Modules\Backend\Controllers;

use Phalcon\Db\Column;
use App\Models\Entities;
use Sb\Framework\Mvc\Model\EagerLoading\Loader;
use Sb\Framework\Mvc\Model\EagerLoading\QueryBuilder;
use App\Forms\User\Create as UserCreateForm;

class UsersController extends BaseController {

    public function initialize()
    {
        parent::initialize();

        $this->users = new Entities\Users;
    }

    public function indexAction()
    {
        // echo $this->flashSession->output();

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

        $this->view->disable();
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

        $this->view->disable();
    }

    public function createAction()
    {
        $form = new UserCreateForm;

        if ($this->request->isPost())
        {
            if ($form->isValid($this->request->getPost()))
            {
                $this->users->assign($this->request->getPost());

                if ($this->users->save())
                {
                    $this->flashSession->success('The new user has been created.');

                    return $this->response->redirect(['for' => 'admin:users']);
                }

                $form->mergeMessages($this->users->getMessages());
            }
        }

        $this->tag->appendTitle('Create a User');

        $this->view->form = $form;
    }

}