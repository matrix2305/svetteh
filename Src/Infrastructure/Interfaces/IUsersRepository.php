<?php


namespace Infrastructure\Interfaces;

use AppCore\Entities\User;

interface IUsersRepository
{
    public function GetAllUsers();

    public function GetOneUser($id);

    public function AddUser(User $user);

    public function UpdateUser(array $data);

    public function DeleteUser(int $id);
}