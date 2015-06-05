<?php namespace App\Models\Repositories;

Interface RepositoryInterface {

    public function findById($id);

    public function findAll();

    public function findWithCretiria();

    public function create($data = []);

    public function update($user, $data = []);

    public function delete($user);

}