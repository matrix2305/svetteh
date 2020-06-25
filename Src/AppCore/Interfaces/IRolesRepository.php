<?php
namespace AppCore\Interfaces;


use AppCore\Entities\Role;

interface IRolesRepository
{
    public function getAllRoles();

    public function getOneRole(int $id);

    public function addRole(Role $role);

    public function updateRole(array $data);

    public function deleteRole(int $id);
}