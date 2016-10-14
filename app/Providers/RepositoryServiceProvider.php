<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
<<<<<<< HEAD
    public function boot()
    {

    }

=======
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
>>>>>>> 67a1585626508a6ca026aa8da6f7993786cf8de4
    public function register()
    {
        $this->app->bind(\App\Repositories\Contracts\CategoryRepository::class, \App\Repositories\Eloquent\CategoryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\PostRepository::class, \App\Repositories\Eloquent\PostRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\TagRepository::class, \App\Repositories\Eloquent\TagRepositoryEloquent::class);
<<<<<<< HEAD
=======
        //:end-bindings:
>>>>>>> 67a1585626508a6ca026aa8da6f7993786cf8de4
    }
}
