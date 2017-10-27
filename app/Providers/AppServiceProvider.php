<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Post;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // View composer for archives
        view()->composer('partials._archives', function($view){
            $archives = \App\Models\Post::archives();

            $view->with(compact('archives'));
        });

        // View composer for tags
        view()->composer('partials._tags', function($view){
            $tags = \App\Models\Tag::withCount('posts')->orderBy('posts_count', 'desc')->get()->take(5);

            $view->with(compact('tags'));
        }); 
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
