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
        $repositories = [
            'UsersRepository', 'CategoriesRepository', 'RolesRepository', 'PostsRepository'
        ];
        foreach ($repositories as $repository){
            $this->app->bind("Infrastructure\Interfaces\I$repository", "Infrastructure\Repository\\$repository");
        }

        //Binding services
        $services = [
            'UsersService', 'PostsService', 'RolesService', 'CategoriesService'
        ];
        foreach ($services as $service){
            $this->app->bind("AppCore\Interfaces\I$service", "AppCore\Services\\$service");
        }

        // Binding Log
        $this->app->bind('Infrastructure\Interfaces\ILog', 'Infrastructure\Log\Log');
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
