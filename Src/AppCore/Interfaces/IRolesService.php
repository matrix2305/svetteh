<?php


namespace AppCore\Interfaces;


interface IRolesService
{
    public function addRole(array $data);

    public function deleteRole(int $id);

    public function updateRole(array $data);

    public function getAllRoles();
}