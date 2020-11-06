<?php


namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PostServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Repositories\PostRepositoryInterface', 'App\Repositories\PostRepository');
    }
}