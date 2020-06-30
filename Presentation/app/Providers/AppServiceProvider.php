<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        $this->app->bind('AppCore\Interfaces\IPostsRepository', 'Infrastructure\Repository\PostsRepository');
        $this->app->bind('AppCore\Interfaces\IContentRepository', 'Infrastructure\Repository\ContentRepository');
        $this->app->bind('AppCore\Interfaces\IMessagesRepository', 'Infrastructure\Repository\MessagesRepository');


        // Binding services
        $this->app->bind('AppCore\Interfaces\IUsersService', 'AppCore\Services\UsersService');
        $this->app->bind('AppCore\Interfaces\IPostsService', 'AppCore\Services\PostsService');
        $this->app->bind('AppCore\Interfaces\IContentService', 'AppCore\Services\ContentService');
        $this->app->bind('AppCore\Interfaces\IMessagesService', 'AppCore\Services\MessagesService');

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
        Schema::defaultStringLength(191);
    }
}
