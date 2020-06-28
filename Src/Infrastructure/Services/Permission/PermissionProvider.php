<?php declare (strict_types = 1);

namespace Infrastructure\Services\Permission;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class PermissionProvider extends ServiceProvider
{

    protected bool $defer = true;

    public function boot()
    {

    }

    public function register()
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('Permission', PermissionFacade::class);
    }
}
