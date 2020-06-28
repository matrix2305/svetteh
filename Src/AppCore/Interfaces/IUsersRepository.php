<?php
namespace AppCore\Interfaces;

use AppCore\Entities\User;
use AppCore\Entities\Role;

interface IUsersRepository
{
    public function getAllUsers();

    public function getOneUser($id);

    public function addUser(User $user);

    public function updateUser(User $user);

    public function deleteUser(User $user);

    public function getUserByEmailorUsername(string $username);

    public function getAllPermissions();

    public function getOnePermission(int $id);

    public function getAllRoles();

    public function getOneRole(int $id);

    public function getRoleByName(string $name);

    public function addRole(Role $role);

    public function updateRole(Role $role);

    public function deleteRole(Role $role);
}