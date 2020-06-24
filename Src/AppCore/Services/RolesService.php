<?php
declare(strict_types = 1);
namespace AppCore\Services;


use AppCore\Entities\Role;
use AppCore\Interfaces\IRolesService;
use Infrastructure\Interfaces\IRolesRepositroy;
use Infrastructure\Repository\RolesRepositroy;

class RolesService implements IRolesService
{
    private RolesRepositroy $RolesRepository;

    public function __construct(IRolesRepositroy $rolesRepositroy)
    {
        $this->RolesRepository = $rolesRepositroy;
    }

    public function getAllRoles() : array
    {
        return $this->RolesRepository->getAllRoles();
    }

    public function addRole(array $data) : void
    {
        $role = new Role();
        $role->setName($data['role_name']);
        $role->setRoleColor($data['role_color']);
        $this->RolesRepository->addRole($role);
    }

    public function updateRole(array $data) : void
    {
        $this->RolesRepository->updateRole($data);
    }

    public function deleteRole(int $id) : void
    {
        $this->RolesRepository->deleteRole($id);
    }
}