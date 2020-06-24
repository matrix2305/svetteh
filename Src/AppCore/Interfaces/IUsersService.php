<?php
namespace AppCore\Interfaces;


interface IUsersService
{
    public function GetAllUsers();

    public function GetOneUser($id);

    public function AddUser(array $data);

    public function UpdateUser(array $data);

    public function DeleteUser($id);

}