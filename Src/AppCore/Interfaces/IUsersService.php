<?php
namespace AppCore\Interfaces;


interface IUsersService
{
    public function getAllUsers();

    public function getOneUser($id);

    public function addUser(array $data);

    public function updateUser(array $data);

    public function deleteUser($id);

}