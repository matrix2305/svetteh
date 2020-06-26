<?php
namespace AppCore\Interfaces;

use AppCore\Entities\User;
use AppCore\Entities\Permissions;
use AppCore\Entities\Role;

interface IUsersRepository
{
    public function getAllUsers();

    public function getOneUser($id);

    public function addUser(User $user);

    public function updateUser(array $data);

    public function deleteUser(int $id);

    public function getUserByEmailorUsername(string $username);

    public function addPermission(Permissions $permissions);

    public function getAllPermissions();

    public function deletePermission(int $id);

    public function updatePermission(array $data);

    public function getAllRoles();

    public function getOneRole(int $id);

    public function addRole(Role $role);

    public function updateRole(array $data);

    public function deleteRole(int $id);
}