<?php


namespace AppCore\DTO;


use AppCore\Entities\Permissions;

class PermissionsDTO extends BaseDTO
{
    public int $id;
    public string $permission;
    public string $name;

    public static function fromEntity(Permissions $permissions)
    {
        return new self(
            [
                'id' => $permissions->getId(),
                'permission' => $permissions->getPermission(),
                'name' => $permissions->getName()
            ]
        );
    }

    public static function fromCollection(array $permissions)
    {
        $permissionsCollection = array();
        if(!empty($permissions)){
            foreach ($permissions as $permission){
                if ($permission instanceof Permissions){
                    $permissionsCollection[] = self::fromEntity($permission);
                }
            }
        }

        return $permissionsCollection;
    }
}