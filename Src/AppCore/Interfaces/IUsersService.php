<?php
namespace AppCore\Interfaces;


interface IUsersService
{
    public function getAllUsers();

    public function getOneUser($id);

    public function addUser(array $data);

    public function updateUser(array $data);

    public function deleteUser(int $id);

    public function login(string $username);

    public function register(string $username);

    public function getAllRoles();

    public function findRoleByName(string $name);

    public function getAllPermissions();

    public function addRole(array $data);

    public function deleteRole(int $id);
}