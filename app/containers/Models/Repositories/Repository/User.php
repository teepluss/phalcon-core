<?php namespace App\Models\Repositories\Repository;

use App\Models\Repositories\BaseRepository;
use App\Models\Repositories\RepositoryInterface;
use App\Models\Repositories\Exceptions\ValidationException;

class User extends BaseRepository implements RepositoryInterface {

    public function getModel()
    {
        return 'Users';
    }

    public function findById($id)
    {

    }

    public function findAll()
    {
        return $this->model->find();
    }

    public function findWithCretiria()
    {

    }

    public function create($data = [])
    {
        $user = $this->model;

        $user->assign($data);

        if ( ! $user->save())
        {
            throw $this->fails($user);
        }

        return $user;
    }

    public function update($user, $data = [])
    {

    }

    public function delete($user)
    {

    }

}