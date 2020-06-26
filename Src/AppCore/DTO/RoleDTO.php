<?php


namespace AppCore\DTO;

use AppCore\Entities\Role;

class RoleDTO extends BaseDTO
{
    public int $id;
    public string $name;
    public string $color;
    public $permissions;

    public static function fromEntity(Role $role){
        return new self(
            [
                'id' => $role->getId(),
                'name' => $role->getName(),
                'color' => $role->getRoleColor(),
                'permissions' => PermissionsDTO::fromCollection($role->getPermissions())
            ]
        );
    }

    public static function fromCollection(array $roles){
        $roleCollection = array();
        if(!empty($roles)){
            foreach ($roles as $role){
                if($role instanceof Role){
                    $roleCollection[] = $role;
                }
            }
        }

        return $roleCollection;
    }
}