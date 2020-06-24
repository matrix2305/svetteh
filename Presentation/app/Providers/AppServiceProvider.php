<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Infrastructure\Interfaces\IUsersRepository', 'Infrastructure\Repository\UsersRepository');
        $this->app->bind('Infrastructure\Interfaces\ILog', 'Infrastructure\Log\Log');
        $this->app->bind('AppCore\Interfaces\IUsersService', 'AppCore\Services\UsersService');
        $this->app->bind('AppCore\Interfaces\ICategoriesService', 'AppCore\Services\CategoriesService');
        $this->app->bind('Infrastructure\Interfaces\ICategoriesRepository', 'Infrastructure\Repository\CategoriesRepository');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
