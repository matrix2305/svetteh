<?php declare (strict_types = 1);


namespace Infrastructure\Services\Permission;
use Illuminate\Support\Facades\Auth;


class Permission
{
    private $permissions;

    public function __construct()
    {
        $this->permissions = Auth::user()->getRole()->getPermissions();
    }

    public function Check($check)
    {
        foreach ($this->permissions as $permission){
            if ($permission->getPermission() == $check){
                return true;
            }
        }
        return false;
    }
}
