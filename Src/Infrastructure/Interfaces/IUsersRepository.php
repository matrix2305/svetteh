<?php


namespace Infrastructure\Interfaces;

use AppCore\Entities\User;

interface IUsersRepository
{
    public function getAllUsers();

    public function getOneUser($id);

    public function addUser(User $user);

    public function updateUser(array $data);

    public function deleteUser(int $id);
}