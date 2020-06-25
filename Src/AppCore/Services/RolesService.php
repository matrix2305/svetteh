<?php
declare(strict_types = 1);
namespace AppCore\Services;

use AppCore\Entities\Role;
use AppCore\Interfaces\IRolesService;
use AppCore\Interfaces\IRolesRepository;

class RolesService implements IRolesService
{
    private IRolesRepository $RolesRepository;

    public function __construct(IRolesRepository $rolesRepositroy)
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