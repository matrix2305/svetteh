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
        // Binding repositories
        $this->app->bind('AppCore\Interfaces\IUsersRepository', 'Infrastructure\Repository\UsersRepository');
        $this->app->bind('AppCore\Interfaces\ICategoriesRepository', 'Infrastructure\Repository\CategoriesRepository');
        $this->app->bind('AppCore\Interfaces\IRolesRepository', 'Infrastructure\Repository\RolesRepository');
        $this->app->bind('AppCore\Interfaces\IPostsRepository', 'Infrastructure\Repository\PostsRepository');

        // Binding services
        $this->app->bind('AppCore\Interfaces\IUsersService', 'AppCore\Services\UsersService');
        $this->app->bind('AppCore\Interfaces\ICategoriesService', 'AppCore\Services\CategoriesService');
        $this->app->bind('AppCore\Interfaces\IRolesService', 'AppCore\Services\RolesService');
        $this->app->bind('AppCore\Interfaces\IPostsService', 'AppCore\Services\PostsService');

        // Binding Log
        $this->app->bind('AppCore\Interfaces\ILog', 'Infrastructure\Log\Log');


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
