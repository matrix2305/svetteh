<?php declare (strict_types = 1);

namespace Infrastructure\Services\Permission;
use Illuminate\Support\Facades\Facade;

class PermissionFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Permission::class;
    }
}
